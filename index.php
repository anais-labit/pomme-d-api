<?php
require_once 'vendor/autoload.php';

use App\Controller\UserController;



$router = new AltoRouter();
// Chemin de base utilisé par vos collègues
$colleaguesBasePath = '/pomme-d-api';
// Chemin de base que vous utilisez
$yourBasePath = '/plateforme/pomme-d-api';

// Récupérer l'URI actuelle
$uri = $_SERVER['REQUEST_URI'];

// Vérifier si l'URI commence par le chemin de base des collègues
if (strpos($uri, $colleaguesBasePath) === 0) {
    // Si c'est le cas, remplacer le chemin de base par le vôtre
    $uri = $yourBasePath . substr($uri, strlen($colleaguesBasePath));
    $router->setBasePath($yourBasePath);
}

$router->setBasePath('/plateforme/pomme-d-api');





$router->map('GET', '/', function () {
    require "home.php";
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




$match = $router->match();

if ($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "404 Not Found";
}
