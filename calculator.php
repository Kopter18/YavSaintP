<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #f4f4f4;
        }
        .calculator {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }
        .input-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 20px 0;
        }
        button {
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: #3498db;
            color: white;
            transition: background 0.3s;
        }
        button:hover {
            background: #2980b9;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }
        .error {
            background: #ffebee;
            color: #c62828;
        }
        .clear-btn {
            background: #95a5a6;
            margin-top: 10px;
        }
        .clear-btn:hover {
            background: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>🧮 Калькулятор</h2>
        
        <form method="post">
            <div class="input-group">
                <label>Первое число:</label>
                <input type="number" name="num1" step="any" required 
                       value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>">
            </div>
            
            <div class="input-group">
                <label>Второе число:</label>
                <input type="number" name="num2" step="any" required
                       value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>">
            </div>
            
            <div class="buttons">
                <button type="submit" name="operation" value="add">+</button>
                <button type="submit" name="operation" value="subtract">-</button>
                <button type="submit" name="operation" value="multiply">×</button>
                <button type="submit" name="operation" value="divide">÷</button>
            </div>
            
            <button type="reset" class="clear-btn" onclick="clearForm()">Очистить</button>
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
                        $error = "❌ Ошибка: деление на ноль невозможно!";
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
                echo "📊 $num1 $symbol $num2 = <span style='color: #27ae60;'>" . round($result, 4) . "</span>";
                echo "</div>";
            }
        }
        ?>
    </div>
    
    <script>
        function clearForm() {
            document.querySelector('input[name="num1"]').value = '';
            document.querySelector('input[name="num2"]').value = '';
        }
    </script>
</body>
</html>
