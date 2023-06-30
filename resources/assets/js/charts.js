import Chart from 'chart.js/auto';
import moment from 'moment';


export class Report {

    constructor(csrfToken, createReportBtn, data = null, failMessage = null) {

        this.csrfToken = csrfToken;
        this.createReportBtn = createReportBtn;
        this.data = data;
        this.failMessage = failMessage;
    }

    /**
     *  Создание графиков
     */

    createChart(color, label, array, type) {

        const context = document.querySelector('#report').getContext('2d');

        const createDataset = (color, label, array) => ({
            borderColor: color,
            backgroundColor: color,
            label,
            data: ( () => array.map( item => {return {x: item.date, y: item.sum}} ) )()
        });

        return new Chart(context, {
            type: type,
            data: {
                datasets: [ 
                    createDataset(color, label, array)
                ]
            },
        });
         
    }

    /**
     *  Связь с сервером
     */

    async requestToServer ( { url, type, date, transaction, newItem, subNewItem } ) {

        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({
                "type": type, "date": date, "transaction": transaction,
                "newItem": newItem, "subNewItem": subNewItem 
            })
        });

        if (response.ok) this.data = Object.values(await response.json());
       
        if (response.status == 422) this.failMessage = await response.json();

    }

    /**
     *  
     */

    sendData() {

        /** Получение пользовательского ввода */ 
        const formReport = document.querySelector('.report');
        const chart = document.querySelector('.chart');
        const url = "http://buh.ua/create/report";
      
        if (this.createReportBtn) {
            this.createReportBtn.addEventListener('click', async () => { 
                let result = [...document.querySelectorAll('form input, form select')]
                    .filter( item =>
                        (item.name == "type-report" && item.checked)
                        || (item.name == "transaction" && item.checked)
                        || (item.name == "subcategory")
                        || (item.name == "category")
                        || (item.name == "period")
                    )
                    .map(item => item.value);

                await this.requestToServer(
                    { url: url, type: result[0], date: [result[1], result[2]], transaction: result[3], 
                        newItem: result[4], subNewItem: result[5]
                    }
                );

                /** Отображение ошибок валидации */
                if (this.failMessage) {
                    let errorConteiner = document.querySelector('.validationErrors > ul');
                
                    for (let key in this.failMessage) {
                        let emptyElement = document.createElement('li');
                        let text = document.createTextNode(this.failMessage[key][0]);
                        emptyElement.appendChild(text);
                        errorConteiner.appendChild(emptyElement);
                        
                        errorConteiner.setAttribute('style', 'display: block');
                    }
                }
                
                /** Отрисовка графиков */
                formReport.setAttribute('style', 'display: none');
                chart.setAttribute('style', 'display: block');
                
                if (result[3] == 'income') this.createChart('green', 'доходи', this.data, result[0]);
                else this.createChart('red', 'видатки', this.data, result[0]);
                
            });
        }
    
    }

}

