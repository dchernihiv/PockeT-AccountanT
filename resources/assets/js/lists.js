export class Lists {

    constructor(
        radioBtn, csrfToken, modalWindowCallBtn, modalWindow, newTitle, addNewItemBtn, createNewItem,
        modifyBtn, valueTargetButton = null, items = null, failMessage = null
    ) {

        this.radioBtn = radioBtn;
        this.csrfToken = csrfToken;
        this.modalWindowCallBtn = modalWindowCallBtn;
        this.modalWindow = modalWindow;
        this.newTitle = newTitle;
        this.addNewItemBtn = addNewItemBtn;
        this.createNewItem = createNewItem;
        this.valueTargetButton = valueTargetButton;
        this.items = items;
        this.failMessage = failMessage;
        this.modifyBtn = modifyBtn;

    }

    async requestToServer
            ({ url, transaction, newItem, subNewItem, currency, targetButton, date, id, sum })
        {

        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({
                "transaction": transaction, "newItem": newItem, "subNewItem": subNewItem, "currency": currency,
                "targetButton": targetButton, "date": date, 'id': id, 'sum': sum
            })
        });

        if (response.ok) {
            this.items = await response.json();
   
            if (this.items.conteiner) {
                const conteiner = document.getElementById(this.items.conteiner);
                conteiner.innerHTML = this.items.html;
            }
        }
        else if (response.status == 422) this.failMessage = await response.json();

    }

    showModalWindow() {

        this.modalWindowCallBtn.forEach(btn => {
            btn.addEventListener('click', event => {

                /***Проверка на наличие ошибок валидации при предыдущем создании новых елементов списка */
                if (this.failMessage) {
                    let errorConteiner = document.querySelector('.validationError');
                    errorConteiner.setAttribute('style', 'display: none');
                    errorConteiner.innerHTML = '';
                    this.failMessage = null;
                }

                /***Установка обработчика на клик кнопки "Вийти" окна создания новых элементов списка */
                document.forms[1]['cancel'].onclick = () => {
                    this.modalWindow.setAttribute('style', 'display: none');
                }

                /***Определение атрибутов и значений текстовых узлов окна создания новых элементов списка */
                if (event.target.value == 'add-category') {
                    this.modalWindow.setAttribute('style', 'display: block');
                    this.newTitle.textContent = 'Додати нову категорію';
                }
                else if (event.target.value == 'add-subcategory') {
                    this.modalWindow.setAttribute('style', 'display: block');
                    this.newTitle.textContent = 'Додати нову підкатегорію для вибраної категорії';
                }
                else {
                    this.modalWindow.setAttribute('style', 'display: block');
                    this.newTitle.textContent = 'Додати нову валюту';
                }

                return this.valueTargetButton = event.target.value;

            });
        });

    }

    createItems(textNode, parentElement, emptyItem = false) {

        let option = document.createElement('option');
        let value = document.createTextNode(textNode);
        option.appendChild(value);
        parentElement.appendChild(option);

        if (emptyItem) {
            let option = document.createElement('option');
            let value = document.createTextNode('');
            option.appendChild(value);
            parentElement.appendChild(option);
        }

    }

    showItems() {

        /**Удаление предыдущих категорий и подкатегорий */
        let category = document.forms[0]['category'];
        let countCat = category.childNodes.length;
        for (let i = 0; i < countCat; i++) {
            category.removeChild(category.firstChild);
        }

        let subcategory = document.forms[0]['subcategory'];
        let countSubCat = subcategory.childNodes.length;
        for (let i = 0; i < countSubCat; i++) {
            subcategory.removeChild(subcategory.firstChild);
        }

        if (document.forms[0]['currency']) {
            let currency = document.forms[0]['currency'];
            let countCur = currency.childNodes.length;
            for (let i = 0; i < countCur; i++) {
                currency.removeChild(currency.firstChild);
            }
        }

        /***Создание начальных строк категорий и подкатегорий*/
        this.createItems('виберіть категорію...', category, true);
        this.createItems('виберіть підкатегорію...', subcategory, true);

        /***Создание списка категорий*/
        Object.keys(this.items[0]).map(item => {
            this.createItems(item, category);
        });

        /***Создание списка подкатегорий*/
        category.addEventListener('change', () => {
            let subcategory = document.forms[0]['subcategory'];
            let countSub = subcategory.childNodes.length;

            for (let i = 0; i < countSub; i++) {
                subcategory.removeChild(subcategory.firstChild);
            }

            let index = category.selectedIndex;
            let key = category[index].innerHTML;

            this.items[0][key].map(item => {
                if (item) {
                    this.createItems(item, subcategory);
                }
            });

        });

        /***Создание списка валют*/
        if (document.forms[0]['currency']) {
            this.items[1].map(item => {
                this.createItems(item, currency);
            });

        }
    }

    initialRenderLists() {

        /** Рендеринг категорий и подкатегорий в зависимости от выбора кнопки "доходы/расходы" */
        let url = "http://buh.ua/show/items";

        this.radioBtn.forEach(btn => {
            btn.addEventListener('click', async event => {
                let transaction = event.target.value;
                await this.requestToServer({ url: url, transaction: transaction });
                this.showItems();
            });
        });
       
    }

    sendNewData() {

        this.showModalWindow();
        if (this.addNewItemBtn) {
            this.addNewItemBtn.addEventListener('click', () => {
                this.modalWindow.setAttribute('style', 'display: none');

                const url = "http://buh.ua/create/titles";
                let newItem,
                    subNewItem,
                    transaction,
                    button,
                    currency;

                if (this.valueTargetButton == 'add-category') {
                    newItem = this.createNewItem.value;
                }
                else if (this.valueTargetButton == 'add-subcategory') {
                    newItem = document.forms[0]['category'].value;
                    subNewItem = this.createNewItem.value;
                }
                else {
                    currency = this.createNewItem.value;
                }

                this.radioBtn.forEach(btn => {
                    if (btn.checked) {
                        transaction = btn.value;
                        button = btn;
                    }
                });

                (async () => {

                    await this.requestToServer({
                        url: url, transaction: transaction, newItem: newItem, subNewItem: subNewItem,
                        currency: currency, targetButton: this.valueTargetButton
                    });

                    if (this.items) button.click();

                    if (this.failMessage) {

                        let errorConteiner = document.querySelector('.validationErrors li');

                        let value = Object.values(this.failMessage);
 
                        let text = document.createTextNode(value[0]);
                        errorConteiner.appendChild(text);

                        errorConteiner.setAttribute('style', 'display: block');
                    }

                })();

            });
        }

    }

    modifyRecords() {

        /** Отображение списка экземпляров модели Transaction за выбраный период*/
        this.modifyBtn.addEventListener('click', async () => {

            const blockVisible = document.querySelectorAll('.button-block > button');
            const url = "http://buh.ua/table/modify";
            let date = [];

            date.push(document.querySelector('input[name="period-start"]').value);
            date.push(document.querySelector('input[name="period-end"]').value);

            await this.requestToServer({ url: url, date: date });
            blockVisible.forEach(button => button.setAttribute('style', 'display: block'));
       
            /** Удаление/изменение выбраных записей в БД*/
            const checkbox = document.querySelectorAll('td > input');
            const hidden = document.querySelectorAll('td[hidden]');
            const destroyBtn = document.querySelector('button[name="remove"]');
            const updateBtn = document.querySelector('button[name="change"]');
            const newData = document.querySelectorAll('.modify input[name^="update"]');
            const applyModify = document.querySelector('button[name="apply-modify"]');
            const outModify = document.querySelector('button[name="cancel"]');
            const urlUpdate = "http://buh.ua/record/update";
            const urlDestroy = "http://buh.ua/record/destroy";
            let modifyData = [];

            for (let i = 0; i < checkbox.length; i++) {
                checkbox[i].addEventListener('change', () => {

                    if (checkbox[i].checked) {
                        /** Получение значений текстовых узлов выбранного пользователем для заполнения полей редактора записей*/
                        let modifyRow = checkbox[i].parentNode.parentNode.childNodes;

                        for (let i = 0; i < modifyRow.length; i++) {
                            if (modifyRow[i].nodeType == 1) modifyData.push(modifyRow[i].innerHTML);
                        }

                        /** Заполнение полей в форме редактирования старыми значениями */
                        updateBtn.addEventListener('click', () => {

                            document.querySelector('.modify').setAttribute('style', 'display: block');
                            document.querySelector('button[name="send-period"]').setAttribute('style', 'display: none');
                            blockVisible.forEach(button => button.setAttribute('style', 'display: none'));

                            for (let i = 0; i < newData.length; i++) {
                                newData[i].value = modifyData[i + 2];
                            }

                            /** Изменение данных выбраной записи в БД */
                            let update = () => {
                                this.requestToServer(
                                    {
                                        url: urlUpdate, id: modifyData[0], date: newData[0].value, transaction: newData[1].value,
                                        newItem: newData[2].value, subNewItem: newData[3].value, sum: newData[4].value, currency: newData[5].value
                                    }
                                );

                                applyModify.removeEventListener('click', update);
                            }

                            applyModify.addEventListener('click', update);

                        });

                        /** Удаление выбранной записи из БД */
                        let id = hidden[i].innerHTML;

                        let destroy = () => {
                           this.requestToServer({ url: urlDestroy, id: id, date: date });
                           destroyBtn.removeEventListener('click', destroy);
                        }
                        
                        destroyBtn.addEventListener('click', destroy);
                    }
                });
            }
        });
    }

    /** Построение графиков */
    createChart() {
        
        const url = "http://buh.ua/create/report";
        const createChart = document.forms[0]['generate'];

        createChart.addEventListener('click', async () => {
            
            let result = [...document.querySelectorAll('form input, form select')].filter( item =>
                    (item.name == "type-report" && item.checked)
                    || (item.name == "transaction" && item.checked)
                    || (item.name == "subcategory")
                    || (item.name == "category")
                    || (item.name == "period")
                )
                .map(item => item.value);
         
            await this.requestToServer(
                { url: url, date: [result[1], result[2]], transaction: result[3], newItem: result[4],
                    subNewItem: result[5]
                }
            );

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



           
        });
                
      
    }

    
}


