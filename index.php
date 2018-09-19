<?php


require_once(dirname(__FILE__) . '/helpers.php');
require_once(dirname(__FILE__) . '/Route.php');

use \App\Route;

$route = new Route();

$route->add('/', function () {
    include dirname(__FILE__) . '/pages/home.php';
    return true;
});

$route->add('/bestellung', function () {
    include dirname(__FILE__) . '/pages/bestellung.php';
    return true;
});

$route->run();
