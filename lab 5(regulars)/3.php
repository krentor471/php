<?php
$string = 'baaa baaab baaa xaaa baaaa';
$result = preg_replace('/\b(b)aaa\b/', '$1!', $string);
echo $result;
?>