export class Lists {

    constructor (
            radioBtn, csrfToken, modalWindowCallBtn, newTitle, addNewItemBtn, createNewItem, 
            modifyBtn, valueTargetButton = null, items = null, failMessage = null
        ) {

        this.radioBtn = radioBtn;
        this.csrfToken = csrfToken;
        this.modalWindowCallBtn = modalWindowCallBtn;
        this.newTitle = newTitle;
        this.addNewItemBtn = addNewItemBtn;
        this.createNewItem = createNewItem;
        this.valueTargetButton = valueTargetButton;
        this.items = items;
        this.failMessage = failMessage;
        this.modifyBtn = modifyBtn;

    }
   
    async requestToServer (
            url, transaction = null, newItem = null,
            subNewItem = null, currency = null, targetButton = null, date
        ) {

        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({
                "transaction": transaction, "newItem": newItem, "subNewItem": subNewItem,
                "currency": currency, "targetButton": targetButton, "date": date
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
        Object.keys(this.items[0]).map( item => {
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

            this.items[1].map( item => {
                this.createItems(item, currency);
            });

        }
    }

    initialRenderLists() {

        let url = "http://buh.ua/show/items";

        this.radioBtn.forEach(btn => {
            btn.addEventListener('click', async event => {

                let transaction = event.target.value;
                await this.requestToServer(url, transaction);
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

                ( async () => { 

                    await this.requestToServer(
                        url, transaction, newItem, subNewItem, currency, this.valueTargetButton
                        );

                    if (this.items) button.click();

                    if (this.failMessage) {

                        let errorConteiner = document.querySelector('.validationErrors li');
                        let value = (this.failMessage.newItem)
                            ? this.failMessage.newItem[0] 
                            : this.failMessage.subNewItem[0];
                        let text = document.createTextNode(value);
                        errorConteiner.appendChild(text);

                        errorConteiner.setAttribute('style', 'display: block');
                    }

                } )();
                
            });
        }

    }

    modifyRecords () {

        this.modifyBtn.addEventListener('click', () => {

            const url = "http://buh.ua/table/modify";
            let date = [];
            date.push(document.querySelector('input[name="period-start"]').value);
            date.push(document.querySelector('input[name="period-end"]').value);
           
            this.requestToServer(url, date);

        });

    }

    destroyRecord(button, url) {

        //const url = "http://buh.ua/record/remove";
        const checkbox = document.querySelector('input[name="choice"]');

        for (let i = 0; )
        if (checkbox.checked) {
            let id =  document.querySelector('td[hidden]').value;

            button.addEventListener('click', () => {
                this.requestToServer(url, id);
            });
        }

    }


}