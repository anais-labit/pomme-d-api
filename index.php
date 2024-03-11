<?php
require_once 'vendor/autoload.php';



$router = new AltoRouter();
$router ->setBasePath('/pomme-d-api');

$router->map('GET', '/', function() {
    require "home.php";
}, "home");





$match = $router->match();

if ($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "404 Not Found";
}


?>