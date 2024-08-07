// let count = 0;
let data = {};
function send(pharma_id, id) {
    data.pharma_id = pharma_id;
    data.id = id;

    localStorage.setItem(localStorage.length.toString(), JSON.stringify(data));
}

$(document).ready(function() {
    getBasket();
});

function getBasket() {
    let basketCount = localStorage.getItem('count');
    for (let i=0; i <= basketCount; i++) {

        console.log(JSON.stringify(localStorage));
        // console.log(localStorage.length);
    }
}

