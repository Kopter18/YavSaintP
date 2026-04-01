<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №12</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .section {
            background: white;
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .task {
            background: #f9f9f9;
            margin: 15px 0;
            padding: 15px;
            border-left: 4px solid #2196F3;
            border-radius: 5px;
        }
        .task h3 {
            margin-top: 0;
            color: #2196F3;
        }
        .result {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            margin-top: 10px;
        }
        .error {
            background: #ffebee;
            color: #c62828;
        }
        .success {
            background: #e8f5e9;
            color: #2e7d32;
        }
        hr {
            margin: 20px 0;
        }
        code {
            background: #f0f0f0;
            padding: 2px 5px;
            border-radius: 3px;
        }
        form {
            background: #fff3e0;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
        }
        input[type="date"] {
            padding: 8px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 8px 15px;
            background: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>
    <h1>📚 Лабораторная работа №12</h1>
    <h2>Обработка исключений и работа с датами</h2>

    <!-- ==================== ЧАСТЬ 1: ИСКЛЮЧЕНИЯ ==================== -->
    <div class="section">
        <h2>🔧 Часть 1: Обработка исключений</h2>

        <!-- Задание 1: Обработка открытия несуществующего файла -->
        <div class="task">
            <h3>Задание 1: Обработка ошибки открытия несуществующего файла</h3>
            <?php
            try {
                $file = @fopen("nonexistent_file.txt", "r");
                if ($file === false) {
                    throw new Exception("Не удалось открыть файл 'nonexistent_file.txt'");
                }
                fclose($file);
                echo '<div class="result success">✅ Файл успешно открыт</div>';
            } catch (Exception $e) {
                echo '<div class="result error">❌ Исключение: ' . $e->getMessage() . '</div>';
                echo '<div class="result">📁 Файл: ' . $e->getFile() . '<br>';
                echo '📍 Строка: ' . $e->getLine() . '</div>';
            }
            ?>
        </div>

        <!-- Задание 2: Деление на ноль -->
        <div class="task">
            <h3>Задание 2: Обработка деления на ноль</h3>
            <?php
            $log_file = "log.txt";
            
            try {
                $a = 10;
                $b = 0;
                
                if ($b == 0) {
                    throw new Exception("Ошибка: деление на ноль! (числитель: $a, знаменатель: $b)");
                }
                
                $result = $a / $b;
                echo '<div class="result success">✅ Результат: ' . $result . '</div>';
                
            } catch (Exception $e) {
                $error_message = date('Y-m-d H:i:s') . " - " . $e->getMessage() . "\n";
                file_put_contents($log_file, $error_message, FILE_APPEND);
                echo '<div class="result error">❌ ' . $e->getMessage() . '</div>';
                echo '<div class="result">📝 Сообщение об ошибке сохранено в файл "' . $log_file . '"</div>';
            }
            ?>
        </div>

        <!-- Задание 3: Доступ к несуществующему элементу массива -->
        <div class="task">
            <h3>Задание 3: Обработка доступа к несуществующему элементу массива</h3>
            <?php
            $countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];
            
            try {
                $country = 'Germany';
                if (!array_key_exists($country, $countries)) {
                    throw new Exception("Страна '$country' не найдена в массиве");
                }
                echo '<div class="result success">✅ Столица ' . $country . ': ' . $countries[$country] . '</div>';
            } catch (Exception $e) {
                echo '<div class="result error">❌ ' . $e->getMessage() . '</div>';
                echo '<div class="result">📋 Доступные страны: ' . implode(', ', array_keys($countries)) . '</div>';
            }
            ?>
        </div>
    </div>

    <!-- ==================== ЧАСТЬ 2: ДАТЫ ==================== -->
    <div class="section">
        <h2>📅 Часть 2: Работа с датами</h2>

        <!-- Задание 1: Timestamp -->
        <div class="task">
            <h3>Задание 1: 15 марта 2025 года, 10:25:00 в формате timestamp</h3>
            <?php
            $timestamp1 = mktime(10, 25, 0, 3, 15, 2025);
            echo '<div class="result">📅 15 марта 2025 года, 10:25:00 = ' . $timestamp1 . ' секунд с 01.01.1970</div>';
            ?>
        </div>

        <!-- Задание 2: Разница между датами -->
        <div class="task">
            <h3>Задание 2: Разница между 2 октября 1990 года и текущим моментом</h3>
            <?php
            $date2 = mktime(8, 5, 59, 10, 2, 1990);
            $now = time();
            $diff = $now - $date2;
            
            echo '<div class="result">';
            echo "📆 2 октября 1990 года, 08:05:59<br>";
            echo "📆 Текущий момент: " . date('d.m.Y H:i:s', $now) . "<br>";
            echo "⏱️ Разница в секундах: " . number_format($diff, 0, '', ' ') . " секунд<br>";
            echo "⏱️ Разница в днях: " . floor($diff / 86400) . " дней<br>";
            echo '</div>';
            ?>
        </div>

        <!-- Задание 3: Текущая дата в формате -->
        <div class="task">
            <h3>Задание 3: Текущая дата-время в формате 'Год.месяц.день Час:Минута:Секунда'</h3>
            <?php
            echo '<div class="result">📅 ' . date('Y.m.d H:i:s') . '</div>';
            ?>
        </div>

        <!-- Задание 4: 1 сентября текущего года -->
        <div class="task">
            <h3>Задание 4: 1 сентября текущего года в формате 'Год.месяц.день'</h3>
            <?php
            $sep1 = mktime(0, 0, 0, 9, 1, date('Y'));
            echo '<div class="result">📅 1 сентября ' . date('Y') . ' года: ' . date('Y.m.d', $sep1) . '</div>';
            ?>
        </div>

        <!-- Задание 5: День недели 2 февраля 2000 года -->
        <div class="task">
            <h3>Задание 5: День недели 2 февраля 2000 года</h3>
            <?php
            $week_days = [
                0 => 'воскресенье',
                1 => 'понедельник',
                2 => 'вторник',
                3 => 'среда',
                4 => 'четверг',
                5 => 'пятница',
                6 => 'суббота'
            ];
            
            $feb2_2000 = mktime(0, 0, 0, 2, 2, 2000);
            $day_num = date('w', $feb2_2000);
            echo '<div class="result">📅 2 февраля 2000 года был ' . $week_days[$day_num] . '</div>';
            ?>
        </div>

        <!-- Задание 6: Массив дней недели -->
        <div class="task">
            <h3>Задание 6: Название текущего дня недели</h3>
            <?php
            $current_day = $week_days[date('w')];
            echo '<div class="result">📅 Сегодня ' . $current_day . ' (' . date('d.m.Y') . ')</div>';
            
            // День рождения (пример: 25 марта)
            $birthday = mktime(0, 0, 0, 3, 25, 2000);
            $birthday_day = $week_days[date('w', $birthday)];
            echo '<div class="result">🎂 25 марта 2000 года был ' . $birthday_day . '</div>';
            ?>
        </div>

        <!-- Задание 7: Сравнение двух дат -->
        <div class="task">
            <h3>Задание 7: Сравнение двух дат</h3>
            <form method="post">
                <label>Первая дата: <input type="date" name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '2025-01-01'; ?>"></label>
                <label>Вторая дата: <input type="date" name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '2025-12-31'; ?>"></label>
                <button type="submit">Сравнить</button>
            </form>
            <?php
            if (isset($_POST['date1']) && isset($_POST['date2'])) {
                $ts1 = strtotime($_POST['date1']);
                $ts2 = strtotime($_POST['date2']);
                
                echo '<div class="result">';
                if ($ts1 > $ts2) {
                    echo "📅 Большая дата: " . $_POST['date1'] . " (первая)";
                } elseif ($ts1 < $ts2) {
                    echo "📅 Большая дата: " . $_POST['date2'] . " (вторая)";
                } else {
                    echo "📅 Даты равны";
                }
                echo '</div>';
            }
            ?>
        </div>

        <!-- Задание 8: Преобразование формата даты -->
        <div class="task">
            <h3>Задание 8: Преобразование формата 'Год-месяц-день' → 'день-месяц-год'</h3>
            <?php
            $date_input = "2025-12-31";
            $timestamp = strtotime($date_input);
            $date_output = date('d-m-Y', $timestamp);
            echo '<div class="result">📅 Исходная дата: ' . $date_input . '<br>';
            echo '📅 Преобразованная дата: ' . $date_output . '</div>';
            ?>
        </div>

        <!-- Задание 9: Прибавление и отнимание дат -->
        <div class="task">
            <h3>Задание 9: Манипуляции с датой '2000.02.03'</h3>
            <?php
            $date = date_create('2000-02-03');
            
            echo '<div class="result">';
            echo "📅 Исходная дата: " . date_format($date, 'd.m.Y') . "<br><br>";
            
            // Прибавляем 2 дня
            date_modify($date, '2 days');
            echo "➕ +2 дня: " . date_format($date, 'd.m.Y') . "<br>";
            
            // Прибавляем 1 месяц
            date_modify($date, '1 month');
            echo "➕ +1 месяц: " . date_format($date, 'd.m.Y') . "<br>";
            
            // Прибавляем 3 дня
            date_modify($date, '3 days');
            echo "➕ +3 дня: " . date_format($date, 'd.m.Y') . "<br>";
            
            // Прибавляем 1 год
            date_modify($date, '1 year');
            echo "➕ +1 год: " . date_format($date, 'd.m.Y') . "<br>";
            
            // Отнимаем 3 дня
            date_modify($date, '-3 days');
            echo "➖ -3 дня: " . date_format($date, 'd.m.Y') . "<br>";
            
            echo '</div>';
            ?>
        </div>

        <!-- Задание 10: Сколько дней до Нового Года -->
        <div class="task">
            <h3>Задание 10: Сколько дней осталось до Нового Года</h3>
            <?php
            $today = time();
            $new_year = mktime(0, 0, 0, 1, 1, date('Y') + 1);
            $days_left = ceil(($new_year - $today) / 86400);
            
            echo '<div class="result">';
            echo "📅 Сегодня: " . date('d.m.Y') . "<br>";
            echo "🎄 До Нового Года осталось: <strong>" . $days_left . "</strong> дней<br>";
            echo "🎉 С наступающим!";
            echo '</div>';
            ?>
        </div>
    </div>

    <!-- Просмотр файла log.txt -->
    <?php if (file_exists("log.txt")): ?>
    <div class="section">
        <h2>📋 Лог ошибок (log.txt)</h2>
        <div class="result">
            <?php
            $log_content = file_get_contents("log.txt");
            echo nl2br(htmlspecialchars($log_content));
            ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="section">
        <h2>📊 Структура созданных файлов</h2>
        <div class="result">
            <?php
            $files = ['log.txt', 'nonexistent_file.txt'];
            foreach ($files as $file) {
                if (file_exists($file)) {
                    echo "📄 $file - " . filesize($file) . " байт<br>";
                } else {
                    echo "📄 $file - не существует<br>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
