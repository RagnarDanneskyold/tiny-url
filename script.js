document.addEventListener("DOMContentLoaded", function () {
    let originalInput = document.querySelector('#originalUrl');
    let tinyInput = document.querySelector('#tinyUrl');
    let loginInput = document.querySelector('#login');
    let passwordInput = document.querySelector('#password');
    let convertBtn = document.querySelector('#convertUrlBtn');
    let authBtn = document.querySelector('#authBtn');
    let tableElement = document.querySelector('#table');

    convertBtn.addEventListener('click' , async function () {
        let response = await ajaxHandler(originalInput.value, 'POST', 'api/create');
        let result = 'http://tiny-url/' + response;
        tinyInput.value = result;
    })

    authBtn.addEventListener('click' , async function () {
        let authData = {
            'login' : loginInput.value,
            'password' : passwordInput.value,
        };
        let response = await ajaxHandler(authData, 'POST', 'api/auth');

        if (response === true) {
            alert('Успешно авторизовались')
            let allUrlsData = await fetch('api/create');
            if (allUrlsData.ok) {
                let data = await allUrlsData.json();
                makeTable(data, tableElement)
            } else {
                alert("Ошибка HTTP: " + response.status);
            }
        } else {
            alert('Неверные логин или пароль')
        }
    })

    async function ajaxHandler(data , method, url) {
        let response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        });
        let result = await response.json();

        return result;
    }

    function makeTable (data, blockEl) {
        let html = '<table border="1" cellpadding="3" style="margin-top: 30px; margin-bottom: 30px">';

        html += '<tr>';
        html += '<td >' + 'id' + '</td>'
        html += '<td >' + 'Длинная ссылка' + '</td>';
        html += '<td >' + 'Короткая ссылка' + '</td>';
        html += '<td >' + 'Дата создания' + '</td>';
        html += '<td >' + '' + '</td>';
        html += '<td >' + '' + '</td>';
        html += '</tr>';

        for(let i = 0; i < data.length; i++)
        {
            html += '<tr>';
            html += '<td >' + data[i].id + '</td>';
            html += '<td >' + data[i].url + '</td>';
            html += '<td >' + data[i].short_url + '</td>';
            html += '<td >' + data[i].created_at  + '</td>';
            html += '<td ><button class="updateBtn" id="url=' + data[i].id + '">' + 'Редактировать' + '</button></td>';
            html += '<td ><button class="deleteBtn" id="url=' + data[i].id + '">' + 'Удалить' + '</button></td>';
            html += '</tr>';
        }

        html += '</table>';
        blockEl.innerHTML = html;
    };
});
