let count = {};
let data = {};
let keyName = 'products';
function send(pharma_id, id) {
    data.pharma_id = pharma_id;
    data.id = id;
    getItemId(data);

}

// Убираю object Object из localStorage
localStorage.setItem(this.keyName, JSON.stringify(count));
const di = localStorage.getItem(this.keyName);
id = JSON.parse(di);

// Добавление товара в корзину
const getItemId = id => {

    console.log(localStorage.setItem(this.keyName, id));
};