<?php
$string = 'ааа ббб ёёё ззз ййй ААА БББ ЁЁЁ ЗЗЗ ЙЙЙ';

preg_match_all('/\b[а-яёА-ЯЁ]+\b/u', $string, $matches);

print_r($matches[0]);
?>