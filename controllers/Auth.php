<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 25.09.18
 * Time: 19:33
 */

namespace App;


class Auth
{
    /**
     * Überprüfen ob User angemeldet ist oder nicht
     * @return bool
     */
    static function check()
    {
        if (isset($_SESSION['auth'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logout des users
     * Cleared die Session
     * @return bool
     */
    static function clear()
    {
        if (Auth::check()) {
            unset($_SESSION['auth']);
        }
        return true;
    }

    /**
     * ID des users erhalten
     * @return null
     */
    static function id()
    {
        if (Auth::check()) {
            $id = $_SESSION['auth'][0]['id'];
            return $id;
        }
        return null;
    }

    /**
     * Name des users erhalten
     * @return null
     */
    static function name()
    {
        if (Auth::check()) {
            $name = $_SESSION['auth'][0]['name'];
            return $name;
        }
        return null;
    }

    /**
     * Session mit userdaten füllen
     * @param $data
     * @return bool
     */
    static function set($data)
    {
        $_SESSION['auth'] = $data;
        return true;
    }
}
