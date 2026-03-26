<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат регистрации</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
        }
        .info {
            background: #e2e3e5;
            padding: 15px;
            border-radius: 5px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <?php
    // Проверяем, была ли отправлена форма методом POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Массив для хранения ошибок
        $errors = [];
        
        // ВАЛИДАЦИЯ: проверяем переданы ли поля email и password
        if (empty($_POST['email'])) {
            $errors[] = "Поле 'Email' обязательно для заполнения";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Введите корректный email адрес";
        }
        
        if (empty($_POST['password'])) {
            $errors[] = "Поле 'Пароль' обязательно для заполнения";
        } elseif (strlen($_POST['password']) < 6) {
            $errors[] = "Пароль должен содержать не менее 6 символов";
        }
        
        // Если есть ошибки - выводим их
        if (!empty($errors)) {
            echo '<div class="error">';
            echo '<h3>❌ Ошибка валидации:</h3>';
            echo '<ul>';
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul>';
            echo '</div>';
        } else {
            // Все поля переданы корректно
            echo '<div class="success">';
            echo '<h3>✅ Регистрация успешно выполнена!</h3>';
            echo '</div>';
            
            echo '<div class="info">';
            echo '<h3>📋 Ваши данные:</h3>';
            
            // Выводим имя (если передано)
            if (!empty($_POST['name'])) {
                echo '<p><strong>Имя:</strong> ' . htmlspecialchars($_POST['name']) . '</p>';
            }
            
            // Выводим email
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($_POST['email']) . '</p>';
            
            // Выводим пол (если передан)
            if (!empty($_POST['gender'])) {
                $gender_text = ($_POST['gender'] === 'male') ? 'Мужской' : 'Женский';
                echo '<p><strong>Пол:</strong> ' . $gender_text . '</p>';
            }
            
            echo '<p><strong>Пароль:</strong> ' . str_repeat('*', strlen($_POST['password'])) . '</p>';
            echo '</div>';
        }
    } else {
        // Если форма не была отправлена методом POST
        echo '<div class="error">';
        echo '<h3>❌ Ошибка:</h3>';
        echo '<p>Форма не была отправлена. Пожалуйста, вернитесь и заполните форму.</p>';
        echo '</div>';
    }
    ?>
    <a href="index.php" class="back-link">← Вернуться к форме регистрации</a>
</body>
</html>
