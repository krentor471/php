<?php
$originalArray = ['a', 'b', 'c', 'd', 'e'];

$uppercaseArray = array_map('strtoupper', $originalArray);

print_r($uppercaseArray);
?>