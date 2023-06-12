import {Lists} from './lists';

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const radioBtn = (document.querySelectorAll('input[name="transaction"]'))
    ? document.querySelectorAll('input[name="transaction"]')
    : null;

const modalWindowCallBtn = (document.querySelectorAll('.add'))
    ? document.querySelectorAll('.add')
    : null

const newTitle = (document.querySelector('.title'))
    ? document.querySelector('.title')
    : null;

const addNewItemBtn = (document.querySelector('button[name="add-item"]'))
    ? document.forms[1]["add-item"]
    : null;

const createNewItem = (document.querySelector('button[name="new-item"]'))
    ? document.forms[1]["new-item"]
    : null;


const modifyBtn = (document.querySelector('button[name="send-period"]'))
    ? document.querySelector('button[name="send-period"]')
    : null;


    
let newItems = new Lists(
    radioBtn, csrfToken, modalWindowCallBtn, newTitle, addNewItemBtn, createNewItem, modifyBtn
);

newItems.initialRenderLists();
newItems.sendNewData();
if (modifyBtn) newItems.modifyRecords();














  

 





