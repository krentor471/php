<?php
$string = 'aaa * bbb ** eee *** kkk ****';
$result = preg_replace('/(?<!\*)\*\*(?!\*)/', '!', $string);
echo $result;
?>