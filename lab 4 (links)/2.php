<?php
$files = ['1.txt', '2.txt', '3.txt'];

foreach ($files as $filename) {
    if (file_exists($filename)) {
        echo "$filename - существует<br>";
    } else {
        echo "$filename - не существует<br>";
    }
}
?>
