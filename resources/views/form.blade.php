<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Форма отправки</title>
</head>
<body>
<h1>Введите URL</h1>
<form action="{{ route('example') }}" method="POST">
    @csrf
    <input type="text" name="url" placeholder="Введите что-нибудь" />
    <button type="submit">Отправить</button>
</form>
</body>
</html>
