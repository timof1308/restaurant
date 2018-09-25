<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 20.09.18
 * Time: 22:54
 */

namespace App;


class DatabaseController
{
    private $_con = null;

    public function __construct()
    {
        $this->conn();
    }

    public function conn()
    {
        $this->_con = new \mysqli(config('db.server'), config('db.user'), config('db.password'), config('db.database'));
        // Check connection
        if ($this->_con->connect_error) {
            die('Connect Error (' . $this->_con->connect_errno . ') '
                . $this->_con->connect_error);
        }
    }

    public function compare_user_credentials(String $user, String $password)
    {
        $pw_encoded = md5($password);
        $sql = "SELECT id, name FROM user WHERE name='" . $user . "' AND password='" . $pw_encoded . "';";
        $parsed = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $parsed = $this->get_as_array($result);
        }
        if (count($parsed) == 0) {
            return false;
        } else {
            return $parsed;
        }
    }

    private function get_as_array($sql_results) {
        $array = array();
        while ($entry = mysqli_fetch_assoc($sql_results)) {
            $tmp = array();
            foreach ($entry as $key => $value) {
                $tmp[$key] = $value;
            }
            $array[] = $tmp;
        }
        return $array;
    }
}
