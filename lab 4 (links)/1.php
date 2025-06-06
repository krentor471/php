<?php
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/test.txt';

if (file_exists($filePath)) {
    $fileSize = filesize($filePath);
    
    echo "Размер файла test.txt: " . formatFileSize($fileSize);
} else {
    echo "Файл test.txt не найден в корне сайта";
}
function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' байт';
    }
}
?>