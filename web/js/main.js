function send(pharma_id, id) {
    $.ajax({
        type: "POST", // метод HTTP, используемый для запроса
        url: "/api/save-anonim-basket", // строка, содержащая URL адрес, на который отправляется запрос
        data: {id:id, pharma_id:pharma_id}, // данные, которые будут отправлены на сервер
        success: function (data) {
            alert(data);
        },
        dataType: "dataType" // тип данных, который вы ожидаете получить от сервера
    });
}
