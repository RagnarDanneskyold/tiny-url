<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сервис коротких ссылок</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Сервис коротких ссылок</h1>
        <input class="input" type="text" id="originalUrl" placeholder="Введите свою ссылку">
        <button class="btn" id="convertUrlBtn">Сократить ссылку</button>
        <input class="input" type="text" id="tinyUrl" placeholder="Результат">
        <button class="btn" id="authBtn">Авторизоваться</button>
        <input class="input" type="text" id="login" placeholder="логин">
        <input class="input" type="text" id="password" placeholder="пароль">
        <div id="table"></div>
    </div>
    <script src="script.js"></script>
</body>
</html>
