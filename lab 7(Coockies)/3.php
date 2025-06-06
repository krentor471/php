<?php
session_start();
if (!isset($_SESSION['refresh_count'])) {
    $_SESSION['refresh_count'] = 0;
    $message = "Вы еще не обновляли страницу.";
} else {
    $_SESSION['refresh_count']++;
    $message = "Количество обновлений: " . $_SESSION['refresh_count'];
}
echo "<h1>Счетчик обновлений</h1>";
echo "<p>$message</p>";
echo "<p>Обновите страницу (F5 или Ctrl+R), чтобы увеличить счетчик.</p>";
echo '<form method="post">
      <input type="submit" name="reset" value="Сбросить счетчик">
      </form>';
if (isset($_POST['reset'])) {
    unset($_SESSION['refresh_count']);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>