<?php
$string = 'a1b2c3';
$result = preg_replace('/[0-9]/', '$0$0', $string);
echo $result;
?>