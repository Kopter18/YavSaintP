<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .calculator {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        button {
            flex: 1;
            padding: 10px;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background: #4CAF50;
            color: white;
        }
        button:hover {
            background: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 4px;
            text-align: center;
            font-size: 18px;
        }
        .error {
            background: #ffebee;
            color: #c62828;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Калькулятор</h2>
        <form method="post">
            <div class="form-group">
                <label>Число 1:</label>
                <input type="number" name="num1" step="any" required>
            </div>
            <div class="form-group">
                <label>Число 2:</label>
                <input type="number" name="num2" step="any" required>
            </div>
            <div class="buttons">
                <button type="submit" name="operation" value="add">+</button>
                <button type="submit" name="operation" value="subtract">-</button>
                <button type="submit" name="operation" value="multiply">*</button>
                <button type="submit" name="operation" value="divide">/</button>
            </div>
        </form>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
            $num1 = (float)$_POST['num1'];
            $num2 = (float)$_POST['num2'];
            $operation = $_POST['operation'];
            $result = null;
            $error = null;
            
            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    $symbol = '+';
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    $symbol = '-';
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    $symbol = '×';
                    break;
                case 'divide':
                    if ($num2 == 0) {
                        $error = "Ошибка: деление на ноль невозможно!";
                    } else {
                        $result = $num1 / $num2;
                        $symbol = '÷';
                    }
                    break;
            }
            
            if ($error) {
                echo "<div class='result error'>$error</div>";
            } elseif ($result !== null) {
                echo "<div class='result'>";
                echo "$num1 $symbol $num2 = " . round($result, 4);
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
