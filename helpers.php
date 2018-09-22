<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 18.09.18
 * Time: 21:37
 */

/**
 * Helper Function zum Abfragen eines Config Eintrages nach einem Pfad
 * @param String $path
 * @return mixed
 */
function config(String $path)
{
    // Array-Pfad wird durch Punkte getrennt
    $path = explode('.', $path);
    $settings = include 'settings.php';
    $val = $settings;
    for ($i = 0; $i < count($path); $i++) {
        $val = $val[$path[$i]];
    }
    return $val;
}

/**
 * Asset link
 * @param $link
 * @return bool
 */
function asset($link)
{
    $absolute_link = config('server.protocol') . $_SERVER['HTTP_HOST'] . config('server.base_url') . $link;
    echo $absolute_link;
    return true;
}

/**
 * JSON http response
 * @param $array
 * @param null $status_code
 * @return bool
 */
function json($array, $status_code = null)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    http_response_code($status_code ? $status_code : 200);
    echo json_encode($array);
    return true;
}
