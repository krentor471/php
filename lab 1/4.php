<?php
$a = 2;
$b = 2.0;
$c = '2';
$d = 'two';
$g = true; 
$f = false;

$float_a = (float)$a;
$float_b = (float)$b;
$float_c = (float)$c;
$float_d = (float)$d;
$float_g = (float)$g;
$float_f = (float)$f;

echo "| Исходная переменная | Исходный тип | Приведённое значение (float) |\n";
echo "|----------------------|---------------|-------------------------------|\n";
echo "| \$a = 2;            | " . gettype($a) . "         | $float_a                      |\n";
echo "| \$b = 2.0;          | " . gettype($b) . "       | $float_b                      |\n";
echo "| \$c = '2';          | " . gettype($c) . "      | $float_c                      |\n";
echo "| \$d = 'two';        | " . gettype($d) . "      | $float_d                      |\n";
echo "| \$g = true;         | " . gettype($g) . "       | $float_g                      |\n";
echo "| \$f = false;        | " . gettype($f) . "       | $float_f                      |\n";
?>