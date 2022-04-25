document.addEventListener("DOMContentLoaded", function () {
    let originalInput = document.querySelector('#originalUrl');
    let tinyInput = document.querySelector('#tinyUrl');
    let btn = document.querySelector('#convertUrl');

    btn.addEventListener('click' , async function () {
        let response = await ajaxHandler(originalInput.value, 'POST', 'api/create');
        let result = 'http://tiny-url/' + response;
        tinyInput.value = result;
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
});
