<?php
$filename = 'test.txt';

$numbers = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$sum = array_sum($numbers);

file_put_contents($filename, "\n$sum", FILE_APPEND);

echo "Сумма чисел: $sum. Результат записан в файл $filename";
?>