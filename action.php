<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    if (empty($_POST['email'])) {
        $errors[] = "Email обязателен";
    }
    if (empty($_POST['password'])) {
        $errors[] = "Пароль обязателен";
    }
    
    if (!empty($errors)) {
        echo "<h3>Ошибка:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul><a href='index.php'>Назад</a>";
    } else {
        echo "<h3>Регистрация успешна!</h3>";
        echo "<p>Имя: " . htmlspecialchars($_POST['name'] ?? '') . "</p>";
        echo "<p>Email: " . htmlspecialchars($_POST['email']) . "</p>";
        echo "<p>Пол: " . ($_POST['gender'] === 'male' ? 'Мужской' : 'Женский') . "</p>";
        echo "<a href='index.php'>Назад</a>";
    }
} else {
    header('Location: index.php');
    exit;
}
?>
