<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обработка формы</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Данные получены</h1>
        <pre>
<?php
print_r($_POST);
?>
        </pre>
        <p><a href="index.php" class="btn">Вернуться к форме</a></p>
    </div>
</body>
</html>
