<?php
$a = 3;
$b = '3';
$d = '3a';

var_dump($a === $b);
var_dump($a == $d);
var_dump($b === $d);
var_dump($d > $a);
var_dump($a != $b);
var_dump($a !== $b);
?>