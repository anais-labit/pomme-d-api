<?php
require_once 'vendor/autoload.php';

use App\Controller\UserController;



$router = new AltoRouter();


$router->setBasePath('/pomme-d-api');

$router->map('GET', '/', function () {
    require "./src/View/home.php";
}, "home");

$router->map('GET', '/register', function () {
    require "./src/View/register.php";
}, "register");

$router->map('POST', '/register', function () {
    $controller = new UserController();
    $controller->register($_POST["login"], $_POST["password"], $_POST["confirm_password"]);
});

$router->map('GET', '/login', function () {
    require "./src/View/login.php";
}, "login");

$router->map('POST', '/login', function () {
    $controller = new UserController();
    $controller->login($_POST["login"], $_POST["password"]);
});



$router->map('GET', '/product/[i:id]', function ($id) {
    require "./src/View/product.php";
}, "product");



$match = $router->match();

if ($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "404 Not Found";
}
