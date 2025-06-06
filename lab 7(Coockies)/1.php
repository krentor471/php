<?php
session_start();

if (!isset($_SESSION['test_data'])) {
    $_SESSION['test_data'] = 'test';
    echo "Значение 'test' было записано в сессию. Обновите страницу.";
} else {
    echo "Содержимое сессии: " . $_SESSION['test_data'];
}
?>