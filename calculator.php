cat > calculator.php << 'EOF'
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Современный калькулятор</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .calculator-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }

        .calculator-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px;
            text-align: center;
        }

        .calculator-header h2 {
            color: white;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .calculator-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }

        .calculator-body {
            padding: 30px;
        }

        .input-group {
            margin-bottom: 25px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }

        .input-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .buttons-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin: 25px 0;
        }

        .operation-btn {
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .operation-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .operation-btn:active {
            transform: translateY(0);
        }

        .clear-btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .clear-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        }

        .result-area {
            margin-top: 25px;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-success {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #155724;
        }

        .result-error {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #721c24;
        }

        .result-area h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .result-value {
            font-size: 28px;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }

        .result-expression {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .footer {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="calculator-container">
        <div class="calculator-header">
            <h2>🧮 Smart Calculator</h2>
            <p>Выполните математические операции</p>
        </div>
        
        <div class="calculator-body">
            <form method="post">
                <div class="input-group">
                    <label>📊 Первое число</label>
                    <input type="number" name="num1" step="any" required 
                           placeholder="Введите число..."
                           value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <label>📈 Второе число</label>
                    <input type="number" name="num2" step="any" required
                           placeholder="Введите число..."
                           value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>">
                </div>
                
                <div class="buttons-grid">
                    <button type="submit" name="operation" value="add" class="operation-btn">+</button>
                    <button type="submit" name="operation" value="subtract" class="operation-btn">−</button>
                    <button type="submit" name="operation" value="multiply" class="operation-btn">×</button>
                    <button type="submit" name="operation" value="divide" class="operation-btn">÷</button>
                </div>
                
                <button type="button" class="clear-btn" onclick="clearForm()">
                    🗑️ Очистить поля
                </button>
            </form>
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
                $num1 = (float)$_POST['num1'];
                $num2 = (float)$_POST['num2'];
                $operation = $_POST['operation'];
                $result = null;
                $error = null;
                $symbol = '';
                
                switch ($operation) {
                    case 'add':
                        $result = $num1 + $num2;
                        $symbol = '+';
                        $operation_name = 'Сложение';
                        break;
                    case 'subtract':
                        $result = $num1 - $num2;
                        $symbol = '−';
                        $operation_name = 'Вычитание';
                        break;
                    case 'multiply':
                        $result = $num1 * $num2;
                        $symbol = '×';
                        $operation_name = 'Умножение';
                        break;
                    case 'divide':
                        if ($num2 == 0) {
                            $error = "❌ Ошибка: деление на ноль невозможно!";
                        } else {
                            $result = $num1 / $num2;
                            $symbol = '÷';
                            $operation_name = 'Деление';
                        }
                        break;
                }
                
                if ($error) {
                    echo '<div class="result-area result-error">';
                    echo '<h3>⚠️ ' . $error . '</h3>';
                    echo '</div>';
                } elseif ($result !== null) {
                    echo '<div class="result-area result-success">';
                    echo '<h3>📐 ' . $operation_name . '</h3>';
                    echo '<div class="result-expression">';
                    echo number_format($num1, 2, '.', '') . ' ' . $symbol . ' ' . number_format($num2, 2, '.', '');
                    echo '</div>';
                    echo '<div class="result-value">';
                    echo '= ' . number_format($result, 4, '.', '');
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        
        <div class="footer">
            <p>✨ Поддерживает целые и дробные числа ✨</p>
        </div>
    </div>
    
    <script>
        function clearForm() {
            document.querySelector('input[name="num1"]').value = '';
            document.querySelector('input[name="num2"]').value = '';
            const resultArea = document.querySelector('.result-area');
            if (resultArea) {
                resultArea.remove();
            }
        }
    </script>
</body>
</html>
EOF
