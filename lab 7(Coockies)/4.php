<?php
session_start();

if (!isset($_SESSION['first_visit'])) {
    $_SESSION['first_visit'] = time();
    $message = "Вы только что зашли на сайт впервые!";
} else {
    $secondsAgo = time() - $_SESSION['first_visit'];
    $message = "С момента вашего первого захода прошло: $secondsAgo секунд";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Счетчик времени</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .time-box { 
            padding: 20px; 
            background: #f0f0f0; 
            display: inline-block;
            border-radius: 5px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Счетчик времени на сайте</h1>
    
    <div class="time-box">
        <?= $message ?>
    </div>
    
    <p>Обновите страницу (F5), чтобы увидеть обновленное время.</p>
    
    <form method="post">
        <button type="submit" name="reset">Сбросить счетчик</button>
    </form>

    <?php
    if (isset($_POST['reset'])) {
        unset($_SESSION['first_visit']);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
    ?>
</body>
</html>