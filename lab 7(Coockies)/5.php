<?php
if (!isset($_COOKIE['test'])) {
    setcookie('test', '123', time() + 3600, '/');
    $message = "Кука 'test' со значением '123' установлена. Обновите страницу.";
} else {
    $message = "Значение куки 'test': " . htmlspecialchars($_COOKIE['test']);
}
echo "<h1>Работа с куками</h1>";
echo "<p>$message</p>";
echo "<p>Обновите страницу (F5), чтобы увидеть результат.</p>";
echo '<form method="post">
      <input type="submit" name="delete" value="Удалить куку">
      </form>';

if (isset($_POST['delete'])) {
    setcookie('test', '', time() - 3600, '/');
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>