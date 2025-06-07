<?php
$string = 'a1b2c3';
$result = preg_replace('/\d/', '$0$0', $string);
echo $result;
?>