<?php

// Автозагрузка классов
spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class) . '.php';
    $file = str_replace('src/', '../src/', $file); // для корректного пути
    if (file_exists(__DIR__ . '/../' . $file)) {
        require __DIR__ . '/../' . $file;
    } elseif (file_exists(__DIR__ . '/../' . strtolower($file))) {
        require __DIR__ . '/../' . strtolower($file);
    }
});

$routes = require __DIR__ . '/route.php';
$route = $_GET['route'] ?? '';

foreach ($routes as $pattern => $controllerAndMethod) {
    if (preg_match($pattern, $route, $matches)) {
        $controller = $controllerAndMethod[0];
        $method = $controllerAndMethod[1];
        $params = array_slice($matches, 1);
        (new $controller)->$method(...$params);
        exit;
    }
}
// Если маршрут не найден
http_response_code(404);
echo '404 Not Found';
