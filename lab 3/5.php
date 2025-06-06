<?php
function cut(string $str, int $length = 10): string
{
    return mb_substr($str, 0, $length, 'UTF-8');
}

echo cut('Привет, мир!');
echo cut('Привет, мир!', 5);
echo cut('Hello world', 3);
echo cut('Тест', 20);
?>