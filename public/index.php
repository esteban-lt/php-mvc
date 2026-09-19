<?php
require __DIR__ . '/../src/config/config.php';

require __DIR__ . '/../src/core/database.php';
require __DIR__ . '/../src/core/helpers.php';
require __DIR__ . '/../src/core/view.php';

require __DIR__ . '/../src/models/Product.php';

require __DIR__ . '/../src/controllers/ProductController.php';

$routes = require __DIR__ . '/../src/routes/web.php';
$key = $_SERVER['REQUEST_METHOD'] . ' ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!isset($routes[$key])) {
    http_response_code(404);
    exit('Página no encontrada');
}

[$class, $action] = $routes[$key];
(new $class())->$action();
