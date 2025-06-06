<?php

$numbers = range(1, 100);

echo "Массив от 1 до 100: \n";

print_r(array_slice($numbers, 0, 5)); // Первые 5 элементов

echo "...\n";

print_r(array_slice($numbers, -5));   // Последние 5 элементов

?>