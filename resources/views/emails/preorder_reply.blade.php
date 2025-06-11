<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ответ на предзаказ</title>
</head>
<body>
    <p>Здравствуйте, {{ $user->name }}!</p>

    <p>Администратор ответил на вашу заявку:</p>
    <p><strong>{{ $adminMessage }}</strong></p>

    <p>Если появились вопросы или предложения, пишите на эту же почту</p>
</body>
</html>