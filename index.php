<!DOCTYPE html>
<html>
<head>
    <title>Задания PHP</title>
</head>
<body>
    <?php
    echo "Задание 1: ";
    $result1 = array_map('strtoupper', ['a', 'b', 'c', 'd', 'e']);
    echo '[\'' . implode('\', \'', $result1) . "']<br><br>";
    
    echo "Задание 2: ";
    $arr2 = [1, 2, 3, 4, 5];
    echo $arr2[count($arr2) - 1] . "<br><br>";
    
    echo "Задание 3: ";
    $arr3 = [1, 2, 3, 4, 5];
    echo (array_search(3, $arr3) !== false ? 'найден' : 'не найден') . "<br><br>";
    
    echo "Задание 4: ";
    $arr4_1 = [1, 2, 3];
    $arr4_2 = ['a', 'b', 'c'];
    $result4 = array_merge($arr4_1, $arr4_2);
    echo '[' . implode(', ', $result4) . "]<br><br>";
    
    echo "Задание 5: ";
    $arr5 = [1, 2, 3, 4, 5];
    $result5 = array_slice($arr5, 1, 3);
    echo '[' . implode(', ', $result5) . "]<br><br>";
    
    echo "Задание 6:<br>";
    $arr6 = ['a' => 1, 'b' => 2, 'c' => 3];
    $keys = array_keys($arr6);
    $values = array_values($arr6);
    echo "keys: ['" . implode("', '", $keys) . "']<br>";
    echo "values: [" . implode(', ', $values) . "]<br><br>";
    
    echo "Задание 7: ";
    $keys7 = ['a', 'b', 'c'];
    $values7 = [1, 2, 3];
    $result7 = array_combine($keys7, $values7);
    echo "['a' => 1, 'b' => 2, 'c' => 3]<br><br>";
    
    echo "Задание 8: ";
    $arr8 = ['a', '-', 'b', '-', 'c', '-', 'd'];
    echo array_search('-', $arr8) . "<br><br>";
    
    echo "Задание 9:<br>";
    $arr9 = ['3' => 'a', '1' => 'c', '2' => 'e', '4' => 'b'];
    
    $arr_asort = $arr9;
    asort($arr_asort);
    echo "asort: ";
    foreach ($arr_asort as $k => $v) echo "$k=>$v ";
    echo "<br>";
    
    $arr_ksort = $arr9;
    ksort($arr_ksort);
    echo "ksort: ";
    foreach ($arr_ksort as $k => $v) echo "$k=>$v ";
    echo "<br>";
    
    $arr_arsort = $arr9;
    arsort($arr_arsort);
    echo "arsort: ";
    foreach ($arr_arsort as $k => $v) echo "$k=>$v ";
    echo "<br><br>";
    
    echo "Задание 10: ";
    $str10 = '1234567890';
    $digits = str_split($str10);
    echo array_sum($digits) . "<br><br>";
    
    echo "Задание 11: ";
    $result11 = array_fill(0, 10, 'x');
    echo '[' . implode(', ', $result11) . "]<br><br>";
    
    echo "Задание 12: ";
    $arr12_1 = [1, 2, 3, 4, 5];
    $arr12_2 = [3, 4, 5, 6, 7];
    $result12 = array_intersect($arr12_1, $arr12_2);
    echo '[' . implode(', ', $result12) . "]<br>";
    ?>
</body>
</html>
