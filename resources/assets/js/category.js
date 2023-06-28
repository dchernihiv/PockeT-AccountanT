import {Lists} from './lists';
import {Report} from './charts';


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const modifyBtn = document.querySelector('button[name="send-period"]');

const radioBtn = (document.querySelectorAll('input[name="transaction"]'))
    ? document.querySelectorAll('input[name="transaction"]')
    : null;

const modalWindowCallBtn = (document.querySelectorAll('.add'))
    ? document.querySelectorAll('.add')
    : null

const modalWindow = (document.querySelector('.window'))
    ? document.querySelector('.window')
    : null;

const newTitle = (document.querySelector('.title'))
    ? document.querySelector('.title')
    : null;

const addNewItemBtn = (document.querySelector('button[name="add-item"]'))
    ? document.querySelector('button[name="add-item"]')
    : null;

const createNewItem = (document.querySelector('input[name="new-item"]'))
    ? document.querySelector('input[name="new-item"]')
    : null;

const createReportBtn = (document.querySelector('input[name="generate"]'))
    ? document.querySelector('input[name="generate"]')
    : null;
    


let newItems = new Lists(
        radioBtn, csrfToken, modalWindowCallBtn, modalWindow, newTitle, addNewItemBtn, createNewItem, modifyBtn
    );
newItems.initialRenderLists();
newItems.sendNewData();
if (modifyBtn) newItems.modifyRecords();


let newChart = new Report(csrfToken, createReportBtn);
newChart.sendData();






















  

 





