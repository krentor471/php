<?php
$c = -27;
$b = -12;

if ($c > 0 && $b > 0) {
    $result = $c ** $b;
    echo "Оба числа положительные. Результат: $c^$b = $result";
} elseif ($c < 0 && $b < 0) {
    $result = $c + $b;
    echo "Оба числа отрицательные. Результат: $c + $b = $result";
} else {
    $result = $c * $b;
    echo "Числа разных знаков. Результат: $c * $b = $result";
}
?>