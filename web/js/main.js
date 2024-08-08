function orderSend() {
    let data_orders = {};
    for (let i=0; i < localStorage.length; i++) {
        drug = localStorage.getItem(i);
        data_orders[i] = (JSON.parse(JSON.parse(drug)));
    }

    $.ajax({
        url: '/order/index',
        method: 'post',
        dataType: 'html',
        data: data_orders,
        success: function(data){
            if (data) {
                localStorage.clear();
                alert('Заказ отправлен');
                document.location.href = '/site/index'
            }
        }
    });
}

$('#buy').click(function(event){
    event.preventDefault();
    orderSend();

});

let data = {};
function send(pharma_id, id) {
     data = $('[data-pharma = "' + pharma_id + '"][data-id="' + id + '"]').text();
     localStorage.setItem(localStorage.length.toString(), JSON.stringify(data));
     alert('Товар добавлен в корзину');
}

$(document).ready(function() {
    getBasket();
});

function getBasket() {
    for (let i=0; i < localStorage.length; i++) {
        drug = localStorage.getItem(i);
        renderRow(JSON.parse(JSON.parse(drug)));
    }
}

function renderRow(drug) {
let html = ' \
        <div className="row"> \
            <div data-key="1" class="margin-auto"> \
                <div className="post class-md-4"> \
                    <h2>' + drug.drug.trade_name + '</h2> \
                    Цена: ' + drug.price + ' <br/>Дозировка: ' + drug.dosage.count + ' ' + drug.dosage.name + ' <br/>\
                    Форма выпуска: ' + drug.form.name + ' <br/>Аптека: Аптека ру \
                    <br/>  Описание \
                    Для симптоматического лечения головной боли, зубной боли, боли в горле, менструальной боли, боли \
                    в спине, мышцах и суставах, слабовыраженной боли при артрите. Повышенная температура тела при \
                    простудных и других инфекционно-воспалительных заболеваниях. \
                </div> \
            </div> \
        </div> \
    ';
    html = $('.container.basket>.row').html() + ' ' + html;

$('.container.basket>.row').html(html);
}
