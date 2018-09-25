<?php

require_once(dirname(__FILE__) . '/helpers.php');
require_once(dirname(__FILE__) . '/Route.php');
require_once(dirname(__FILE__) . '/controllers/TestController.php');
require_once(dirname(__FILE__) . '/controllers/AuthController.php');
require_once(dirname(__FILE__) . '/controllers/DatabaseController.php');
require_once(dirname(__FILE__) . '/controllers/Auth.php');

use \App\Route;

/* Neue PHP Session starten */
session_start();

// wenn keine Sprache gewählt -> auf Language Fallback
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = config('lang_fallback');
}

$route = new Route();

$route->add('GET', '/', function () {
    include dirname(__FILE__) . '/pages/home.php';
    return true;
});

$route->add('GET', '/bestellung', function () {
    include dirname(__FILE__) . '/pages/bestellung.php';
    return true;
});

$route->add('GET', '/login', '\App\AuthController::login');
$route->add('POST', '/login', '\App\AuthController::authenticate');
$route->add('GET', '/logout', '\App\AuthController::logout');

/*
 * Sprach Routen
 */
$route->add('GET', '/de', function () {
    $_SESSION['lang'] = "de";
    header('Location: ' . config('server.protocol') . $_SERVER['HTTP_HOST'] . config('server.base_url'));
});
$route->add('GET', '/en', function () {
    $_SESSION['lang'] = "en";
    header('Location: ' . config('server.protocol') . $_SERVER['HTTP_HOST'] . config('server.base_url'));
});


$route->add('GET', '/test', '\App\TestController::test');
$route->add('GET', '/test\/(\d*)', '\App\TestController::regex');

$route->run();
