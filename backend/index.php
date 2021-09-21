<?php

use app\controllers\AuthController;
use app\controllers\StudentController;

require "bootstrap.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$endPoint = $uri[1];

// allowed endpoints
// everything else results in a 404 Not Found
if (!in_array($endPoint, ['auth', 'users'])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($endPoint) {
    case 'auth':
        $controller = new AuthController();
        $controller->processRequest($requestMethod);
        break;
    case 'users':
        $controller = new StudentController();
        $controller->processRequest($requestMethod);
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        break;
}
