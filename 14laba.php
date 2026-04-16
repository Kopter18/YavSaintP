<?php
// Определяем текущую страницу из параметра URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Обработка формы обратной связи
$form_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_message'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $form_message = '<div class="success-message">Спасибо, ' . $name . '! Ваше сообщение отправлено.</div>';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        if ($page == 'home') echo 'Главная страница';
        elseif ($page == 'page1') echo 'Страница 1 - О нас';
        elseif ($page == 'page2') echo 'Страница 2 - Контакты';
        else echo 'Страница не найдена';
    ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        nav {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }

        nav a {
            color: #333;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        nav a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        nav a.active {
            background: #667eea;
            color: white;
        }

        main {
            padding: 40px;
            min-height: 400px;
        }

        main h2 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
            display: inline-block;
        }

        main h3 {
            color: #555;
            margin: 20px 0 10px 0;
        }

        main p {
            line-height: 1.6;
            color: #666;
            margin-bottom: 15px;
        }

        .info-box {
            background: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .info-box ul {
            list-style: none;
            padding-left: 0;
        }

        .info-box li {
            padding: 5px 0;
            color: #555;
        }

        .contact-info, .contact-form {
            background: #f9f9f9;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
        }

        .contact-info ul {
            list-style: none;
            padding-left: 0;
        }

        .contact-info li {
            padding: 10px 0;
            color: #555;
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: transform 0.2s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }

        .error-page {
            text-align: center;
            padding: 60px 20px;
        }

        .error-page h2 {
            color: #dc3545;
            font-size: 2em;
            margin-bottom: 20px;
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
            }
            
            header h1 {
                font-size: 1.8em;
            }
            
            nav a {
                display: inline-block;
                margin: 5px;
                padding: 8px 15px;
                font-size: 14px;
            }
            
            main {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><?php
                if ($page == 'home') echo 'Добро пожаловать';
                elseif ($page == 'page1') echo 'О нас';
                elseif ($page == 'page2') echo 'Контакты';
                else echo '404';
            ?></h1>
            <p><?php
                if ($page == 'home') echo 'Главная страница нашего сайта';
                elseif ($page == 'page1') echo 'Информация о проекте';
                elseif ($page == 'page2') echo 'Свяжитесь с нами';
                else echo 'Страница не найдена';
            ?></p>
        </header>

        <nav>
            <a href="?page=home" class="<?php echo $page == 'home' ? 'active' : ''; ?>">Главная</a>
            <a href="?page=page1" class="<?php echo $page == 'page1' ? 'active' : ''; ?>">Страница 1</a>
            <a href="?page=page2" class="<?php echo $page == 'page2' ? 'active' : ''; ?>">Страница 2</a>
        </nav>

        <main>
            <?php if ($page == 'home'): ?>
                <!-- Главная страница -->
                <h2>О нас</h2>
                <p>Это пример многостраничного сайта на PHP. Вы находитесь на главной странице.</p>
                <p>Вы можете перейти на другие страницы с помощью навигационного меню выше.</p>
                
                <div class="info-box">
                    <h3>Особенности сайта:</h3>
                    <ul>
                        <li>✓ Работает на PHP</li>
                        <li>✓ Три страницы в одном файле</li>
                        <li>✓ Адаптивный дизайн</li>
                        <li>✓ Легко настраивается</li>
                    </ul>
                </div>

            <?php elseif ($page == 'page1'): ?>
                <!-- Первая подчинённая страница -->
                <h2>О проекте</h2>
                <p>Это первая подчинённая страница. Здесь можно разместить подробную информацию о вашем проекте, компании или услугах.</p>
                
                <h3>Наша миссия</h3>
                <p>Создание качественных веб-решений, которые помогают бизнесу расти и развиваться в цифровом пространстве.</p>
                
                <h3>Наши ценности</h3>
                <ul>
                    <li>Качество и надёжность</li>
                    <li>Инновационный подход</li>
                    <li>Клиентоориентированность</li>
                    <li>Профессионализм</li>
                </ul>
                
                <div class="info-box">
                    <p><strong>PHP версия:</strong> <?php echo phpversion(); ?></p>
                    <p><strong>Текущее время:</strong> <?php echo date("d.m.Y H:i:s"); ?></p>
                </div>

            <?php elseif ($page == 'page2'): ?>
                <!-- Вторая подчинённая страница -->
                <h2>Свяжитесь с нами</h2>
                <p>Это вторая подчинённая страница. Здесь можно разместить контактную информацию и форму обратной связи.</p>
                
                <?php echo $form_message; ?>
                
                <div class="contact-info">
                    <h3>Наши контакты:</h3>
                    <ul>
                        <li>📧 Email: info@example.com</li>
                        <li>📱 Телефон: +7 (123) 456-78-90</li>
                        <li>📍 Адрес: г. Москва, ул. Примерная, д. 123</li>
                    </ul>
                </div>
                
                <div class="contact-form">
                    <h3>Форма обратной связи</h3>
                    <form method="POST" action="?page=page2">
                        <div class="form-group">
                            <label for="name">Имя:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Сообщение:</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" name="send_message" class="submit-btn">Отправить</button>
                    </form>
                </div>

            <?php else: ?>
                <!-- Страница 404 -->
                <div class="error-page">
                    <h2>404 - Страница не найдена</h2>
                    <p>Извините, запрошенная страница не существует.</p>
                    <p><a href="?page=home" style="color: #667eea;">Вернуться на главную</a></p>
                </div>
            <?php endif; ?>
        </main>

        <footer>
            <p>&copy; <?php echo date("Y"); ?> Мой PHP сайт. Все права защищены.</p>
            <p>Работает на одном PHP файле</p>
        </footer>
    </div>
</body>
</html>
