<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 18.09.18
 * Time: 21:37
 */

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

/**
 * Helper Function zum Abfragen eines Config Eintrages nach einem Pfad
 * @param String $path
 * @return mixed
 */
function config(String $path)
{
    $file_name = "settings.php";
    $val = get_data_from_array_string($path, $file_name);
    return $val;
}

/**
 * Übersetzer Funktion
 * Erhält Wert aus Sprachdatei
 * @param String $path
 * @return mixed|null
 */
function translate(String $path)
{
    $file_name = "lang/" . $_SESSION['lang'] . ".php";
    $val = get_data_from_array_string($path, $file_name);
    if ($val == null) {
        // auf lang-fallback zurückgreifen wenn keine sprachdatei gefunden
        $file_name = "lang/" . config('lang_fallback') . ".php";
        $val = get_data_from_array_string($path, $file_name);
    }
    echo $val;
    return $val;
}

/**
 * Erhalte wert aus array, der als "string" formatiert ist
 * @param String $path
 * @param String $file_name
 * @return mixed|null
 */
function get_data_from_array_string(String $path, String $file_name)
{
    // Array-Pfad wird durch Punkte getrennt
    $paths = explode('.', $path);

    // überprüfen ob datei existiert
    if (file_exists($file_name)) {
        $array = include $file_name;
        // zwischenspeichern in neuer variable
        $val = $array;
        // durchloopen (von rechts nach links aus ursprünglichem string
        for ($i = 0; $i < count($paths); $i++) {
            $val = $val[$paths[$i]];
        }
        return $val;
    } else { // sonst gebe null zurück
        return null;
    }
}

function flash(String $data, String $status = null)
{
    $_SESSION['flash'] = array(
        'data' => $data,
        'status' => $status ? $status : "default"
    );
}
