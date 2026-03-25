<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Форма регистрации</h2>
        <form action="action.php" method="post">
            <div class="form-group">
                <label>Имя:</label>
                <input type="text" name="name" placeholder="Введите имя">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required placeholder="example@mail.ru">
            </div>
            <div class="form-group">
                <label>Пароль:</label>
                <input type="password" name="password" required placeholder="Введите пароль">
            </div>
            <div class="form-group">
                <label>Пол:</label>
                <select name="gender">
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Зарегистрироваться">
            </div>
        </form>
    </div>
</body>
</html>
