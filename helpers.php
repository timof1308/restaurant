<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 18.09.18
 * Time: 21:37
 */

/**
 * Helper Function zum Abfragen eines Config Eintrages
 * @return mixed
 */
function config()
{
    $settings = include 'settings.php';
    return $settings;
}

function asset($link)
{
    $absolute_link = config()['server']['protocol'] . $_SERVER['HTTP_HOST'] . config()['server']['base_url'] . $link;
    echo $absolute_link;
}
