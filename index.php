<?php

require_once(dirname(__FILE__) . '/helpers.php');
require_once(dirname(__FILE__) . '/Route.php');
require_once(dirname(__FILE__) . '/controllers/Auth.php');
require_once(dirname(__FILE__) . '/controllers/AuthController.php');
require_once(dirname(__FILE__) . '/controllers/DatabaseController.php');
require_once(dirname(__FILE__) . '/controllers/BestellungController.php');
require_once(dirname(__FILE__) . '/controllers/KuechenController.php');

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

$route->add('GET', '/tisch', '\App\BestellungController::showTables');
$route->add('GET', '/tisch\/(\d*)', '\App\BestellungController::getTable');
$route->add('GET', '/kueche', '\App\KuechenController::index');
$route->add('GET', '/gerichte', '\App\KuechenController::get_gerichte');
$route->add('GET', '/kategorie_gerichte\/(\d*)', '\App\KuechenController::get_gerichte_by_kategorie');
$route->add('GET', '/kategorien', '\App\KuechenController::get_kategorien');
$route->add('GET', '/tisch_bestellung\/(\d*)', '\App\KuechenController::get_order_by_table');
$route->add('GET', '/bestellung_position\/(\d*)', '\App\KuechenController::get_positions_by_order');
$route->add('GET', '/gericht\/(\d*)', '\App\KuechenController::get_gericht');
$route->add('GET', '/revoke_position\/(\d*)', '\App\KuechenController::revoke_position');
$route->add('POST', '/bestellung', '\App\KuechenController::create_order');
$route->add('POST', '/position', '\App\KuechenController::create_position');
$route->add('POST', '/bestellung\/(\d*)', '\App\KuechenController::update_order_status');
$route->add('GET', '/paying\/(\d*)', '\App\KuechenController::paying_order');
$route->add('GET', '/order_payed\/(\d*)', '\App\KuechenController::order_payed');
$route->add('GET', '/view_bill\/(\d*)', '\App\KuechenController::view_bill');

/*
 * Authentifizierungs Routen
 */
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

$route->add('GET', '/impressum', function () {
    include dirname(__FILE__) . '/pages/impressum.php';
    return true;
});

$route->run();
