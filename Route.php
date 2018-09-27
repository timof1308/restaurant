<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 18.09.18
 * Time: 21:36
 */

namespace App;

/**
 * Route Klasse
 * fuer HTTP Routen
 * @package App
 */
class Route
{
    private $_methods = array();
    private $_uri = array();
    private $_callable = array();

    /**
     * Function add
     * Registrieren einer Route
     * @param String $mehtod
     * @param String $uri
     * @param null $callable
     */
    public function add(String $mehtod, String $uri, $callable = null)
    {
        // http methode abspeichern
        $this->_methods[] = strtoupper($mehtod);
        // sicherstellen, dass alle Routen das gleiche Format haben
        $this->_uri[] = '/' . trim($uri, '/');

        if ($callable != null) {
            $this->_callable[] = $callable;
        }
    }

    /**
     * Function run
     * Routen aufrufbar machen
     * @return bool
     */
    public function run()
    {
        // validieren der aufgerufenen URL im Browser
        $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        // Aufgerufene URL nach dem passenden Eintrag prüfen
        foreach ($this->_uri as $key => $value) {
            // prüfen ob URL korrekt
            if (preg_match_all("#^$value$#", $uriGetParam, $matches)) {
                if ($this->_methods[$key] == $_SERVER['REQUEST_METHOD']) {
                    // Funktion aufrufen
                    call_user_func($this->_callable[$key], isset($matches[1]) ? $matches[1][0] : $matches);
                    return true;
                } else {
                    // http methode stimmt nicht überein
                    http_response_code(404);
                    header('Not Found');
                    include dirname(__FILE__) . '/pages/404.php';
                }
            }
        }
        // keine URL wurde für den Aufruf registiert
        http_response_code(404);
        header('Not Found');
        include dirname(__FILE__) . '/pages/404.php';
        return false;
    }
}
