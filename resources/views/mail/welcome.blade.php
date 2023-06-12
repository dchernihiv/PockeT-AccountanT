<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PockeT AccountanT</title>
</head>
<body>
    <h3>Ваш обліковий запис містить наступні дані </h3>
    <p>Логін: {{ $event->email }}</p>
    <p>Пароль: {{ $event->password }}</p>
</body>
</html>