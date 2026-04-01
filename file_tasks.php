<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Работа с файлами в PHP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .task {
            background: white;
            margin: 15px 0;
            padding: 15px;
            border-left: 4px solid #4CAF50;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .task h3 {
            margin-top: 0;
            color: #4CAF50;
        }
        .result {
            background: #e8f5e9;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            margin-top: 10px;
        }
        .error {
            background: #ffebee;
            color: #c62828;
        }
        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>📁 Лабораторная работа №11</h1>
    <h2 style="text-align:center">Работа с файлами и папками в PHP</h2>
    <hr>

    <?php
    echo '<div class="task">';
    echo '<h3>Задание 1: Создание файла test.txt и запись в него</h3>';
    
    // 1. Создайте файл 'test.txt' и запишите в него фразу 'Привет, мир!'
    $file = fopen("test.txt", "w");
    if ($file) {
        fwrite($file, "Привет, мир!");
        fclose($file);
        echo '<div class="result">✅ Файл "test.txt" создан и записана фраза "Привет, мир!"</div>';
    } else {
        echo '<div class="result error">❌ Ошибка создания файла</div>';
    }
    echo '</div>';
    
    // 2. Считайте данные из файла 'test.txt' и выведите их на экран
    echo '<div class="task">';
    echo '<h3>Задание 2: Чтение данных из test.txt</h3>';
    if (file_exists("test.txt")) {
        $content = file_get_contents("test.txt");
        echo '<div class="result">📖 Содержимое файла: <strong>' . htmlspecialchars($content) . '</strong></div>';
    } else {
        echo '<div class="result error">❌ Файл не найден</div>';
    }
    echo '</div>';
    
    // 3. Переименуйте файл 'test.txt' в 'mir.txt'
    echo '<div class="task">';
    echo '<h3>Задание 3: Переименование test.txt в mir.txt</h3>';
    if (file_exists("test.txt")) {
        if (rename("test.txt", "mir.txt")) {
            echo '<div class="result">✅ Файл переименован из "test.txt" в "mir.txt"</div>';
        } else {
            echo '<div class="result error">❌ Ошибка переименования</div>';
        }
    } else {
        echo '<div class="result error">❌ Файл test.txt не найден</div>';
    }
    echo '</div>';
    
    // 4. Создайте папку 'folder' и переместите файл 'mir.txt' в эту папку
    echo '<div class="task">';
    echo '<h3>Задание 4: Создание папки folder и перемещение файла</h3>';
    
    // Создаём папку если её нет
    if (!file_exists("folder")) {
        mkdir("folder");
        echo '<div class="result">📁 Папка "folder" создана</div>';
    }
    
    // Перемещаем файл
    if (file_exists("mir.txt")) {
        if (rename("mir.txt", "folder/mir.txt")) {
            echo '<div class="result">✅ Файл "mir.txt" перемещён в папку "folder"</div>';
        } else {
            echo '<div class="result error">❌ Ошибка перемещения</div>';
        }
    } else {
        echo '<div class="result error">❌ Файл mir.txt не найден</div>';
    }
    echo '</div>';
    
    // 5. Создайте копию файла 'mir.txt' и назовите ее 'world.txt'
    echo '<div class="task">';
    echo '<h3>Задание 5: Создание копии файла world.txt</h3>';
    if (file_exists("folder/mir.txt")) {
        if (copy("folder/mir.txt", "folder/world.txt")) {
            echo '<div class="result">✅ Создана копия файла: "world.txt" в папке "folder"</div>';
        } else {
            echo '<div class="result error">❌ Ошибка копирования</div>';
        }
    } else {
        echo '<div class="result error">❌ Исходный файл не найден</div>';
    }
    echo '</div>';
    
    // 6. Определите размер файла 'world.txt'
    echo '<div class="task">';
    echo '<h3>Задание 6: Размер файла world.txt</h3>';
    $file_path = "folder/world.txt";
    if (file_exists($file_path)) {
        $size_bytes = filesize($file_path);
        $size_kb = $size_bytes / 1024;
        $size_mb = $size_kb / 1024;
        $size_gb = $size_mb / 1024;
        
        echo '<div class="result">';
        echo "📊 Размер файла \"world.txt\":<br>";
        echo "• " . $size_bytes . " байт<br>";
        echo "• " . round($size_kb, 4) . " КБ (килобайт)<br>";
        echo "• " . round($size_mb, 8) . " МБ (мегабайт)<br>";
        echo "• " . round($size_gb, 12) . " ГБ (гигабайт)<br>";
        echo '</div>';
    } else {
        echo '<div class="result error">❌ Файл world.txt не найден</div>';
    }
    echo '</div>';
    
    // 7. Удалите файл 'world.txt'
    echo '<div class="task">';
    echo '<h3>Задание 7: Удаление файла world.txt</h3>';
    if (file_exists("folder/world.txt")) {
        if (unlink("folder/world.txt")) {
            echo '<div class="result">✅ Файл "world.txt" удалён</div>';
        } else {
            echo '<div class="result error">❌ Ошибка удаления</div>';
        }
    } else {
        echo '<div class="result">ℹ️ Файл "world.txt" уже удалён или не существует</div>';
    }
    echo '</div>';
    
    // 8. Проверьте существование файлов 'world.txt' и 'mir.txt'
    echo '<div class="task">';
    echo '<h3>Задание 8: Проверка существования файлов</h3>';
    echo '<div class="result">';
    
    $world_exists = file_exists("folder/world.txt");
    $mir_exists = file_exists("folder/mir.txt");
    
    echo "📄 Файл \"world.txt\": " . ($world_exists ? "✅ существует" : "❌ не существует") . "<br>";
    echo "📄 Файл \"mir.txt\": " . ($mir_exists ? "✅ существует" : "❌ не существует");
    
    echo '</div>';
    echo '</div>';
    
    // ==================== ЧАСТЬ 2 ====================
    echo '<hr>';
    echo '<h2 style="text-align:center">📂 Часть 2</h2>';
    
    // 1. Создайте папку 'test'
    echo '<div class="task">';
    echo '<h3>Задание 1 (Часть 2): Создание папки test</h3>';
    if (!file_exists("test")) {
        if (mkdir("test")) {
            echo '<div class="result">✅ Папка "test" создана</div>';
        } else {
            echo '<div class="result error">❌ Ошибка создания папки</div>';
        }
    } else {
        echo '<div class="result">ℹ️ Папка "test" уже существует</div>';
    }
    echo '</div>';
    
    // 2. Переименуйте папку 'test' на 'www'
    echo '<div class="task">';
    echo '<h3>Задание 2 (Часть 2): Переименование папки test в www</h3>';
    if (file_exists("test")) {
        if (rename("test", "www")) {
            echo '<div class="result">✅ Папка переименована из "test" в "www"</div>';
        } else {
            echo '<div class="result error">❌ Ошибка переименования</div>';
        }
    } else {
        echo '<div class="result error">❌ Папка "test" не найдена</div>';
    }
    echo '</div>';
    
    // 3. Удалите папку 'www'
    echo '<div class="task">';
    echo '<h3>Задание 3 (Часть 2): Удаление папки www</h3>';
    if (file_exists("www")) {
        // Папка должна быть пустой для удаления
        if (rmdir("www")) {
            echo '<div class="result">✅ Папка "www" удалена</div>';
        } else {
            echo '<div class="result error">❌ Ошибка удаления папки (возможно, папка не пуста)</div>';
        }
    } else {
        echo '<div class="result">ℹ️ Папка "www" уже удалена или не существует</div>';
    }
    echo '</div>';
    
    // 4. Дан массив со строками. Создайте в папке 'test' папки с названиями из массива
    echo '<div class="task">';
    echo '<h3>Задание 4 (Часть 2): Создание папок из массива</h3>';
    
    // Создаём папку test если её нет
    if (!file_exists("test")) {
        mkdir("test");
        echo '<div class="result">📁 Папка "test" создана</div>';
    }
    
    $folders = ["documents", "images", "videos", "archives", "temp"];
    echo '<div class="result">';
    echo "📋 Массив названий папок: " . implode(", ", $folders) . "<br><br>";
    
    foreach ($folders as $folder) {
        $path = "test/" . $folder;
        if (!file_exists($path)) {
            if (mkdir($path)) {
                echo "✅ Папка \"$folder\" создана<br>";
            } else {
                echo "❌ Ошибка создания папки \"$folder\"<br>";
            }
        } else {
            echo "ℹ️ Папка \"$folder\" уже существует<br>";
        }
    }
    echo '</div>';
    echo '</div>';
    
    // 5. Выведите все файлы с расширением jpg из текущей папки
    echo '<div class="task">';
    echo '<h3>Задание 5 (Часть 2): Поиск всех .jpg файлов в текущей папке</h3>';
    echo '<div class="result">';
    
    $jpg_files = glob("*.jpg");
    $jpeg_files = glob("*.jpeg");
    $all_images = array_merge($jpg_files, $jpeg_files);
    
    if (count($all_images) > 0) {
        echo "📸 Найдено " . count($all_images) . " файлов:<br>";
        foreach ($all_images as $file) {
            echo "• " . $file . " (размер: " . filesize($file) . " байт)<br>";
        }
    } else {
        echo "📷 Файлов с расширением .jpg или .jpeg не найдено в текущей папке";
    }
    echo '</div>';
    echo '</div>';
    
    // Дополнительно: покажем структуру созданных папок
    echo '<div class="task">';
    echo '<h3>📁 Структура созданных папок и файлов</h3>';
    echo '<div class="result">';
    
    function showStructure($dir, $level = 0) {
        if (!file_exists($dir)) return;
        $files = scandir($dir);
        $indent = str_repeat("&nbsp;&nbsp;&nbsp;", $level);
        
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $path = $dir . "/" . $file;
                if (is_dir($path)) {
                    echo $indent . "📁 " . $file . "/<br>";
                    showStructure($path, $level + 1);
                } else {
                    $size = filesize($path);
                    echo $indent . "📄 " . $file . " (" . $size . " байт)<br>";
                }
            }
        }
    }
    
    echo "<strong>Папка folder:</strong><br>";
    showStructure("folder");
    echo "<br><strong>Папка test:</strong><br>";
    showStructure("test");
    
    echo '</div>';
    echo '</div>';
    ?>
</body>
</html>
