<?php
$string = 'ave a#b a2b a$b a4b a5b a-b acb';
preg_match_all('/\ba\Wb\b/', $string, $matches);
print_r($matches[0]);
?>