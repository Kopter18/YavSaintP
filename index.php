<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация пользователя</h1>
        
        <form action="action.php" method="post" class="registration-form">
            <!-- Поле для имени -->
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
            </div>
            
            <!-- Поле для фамилии -->
            <div class="form-group">
                <label for="surname">Фамилия:</label>
                <input type="text" id="surname" name="surname" placeholder="Введите вашу фамилию" required>
            </div>
            
            <!-- Поле для email (type="email" для валидации) -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" required>
            </div>
            
            <!-- Поле для пароля -->
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" placeholder="Придумайте пароль" required>
            </div>
            
            <!-- Поле для подтверждения пароля -->
            <div class="form-group">
                <label for="confirm_password">Подтверждение пароля:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Повторите пароль" required>
            </div>
            
            <!-- Выпадающий список для выбора пола (добавлено по заданию) -->
            <div class="form-group">
                <label for="gender">Пол:</label>
                <select id="gender" name="gender" required>
                    <option value="">Выберите пол</option>
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                    <option value="other">Другой</option>
                </select>
            </div>
            
            <!-- Дата рождения -->
            <div class="form-group">
                <label for="birthdate">Дата рождения:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>
            
            <!-- Чекбокс с согласием -->
            <div class="form-group checkbox">
                <label>
                    <input type="checkbox" name="agree" required>
                    Я согласен с условиями обработки персональных данных
                </label>
            </div>
            
            <!-- Кнопка отправки -->
            <div class="form-group">
                <button type="submit" class="btn">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</body>
</html>
