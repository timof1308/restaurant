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

    /**
     * DatabaseController constructor.
     * Verbindung zum Server aufbauen
     */
    public function __construct()
    {
        $this->conn();
    }

    /**
     * Baue Verbindung zur Datenbank auf
     */
    public function conn()
    {
        $this->_con = new \mysqli(config('db.server'), config('db.user'), config('db.password'), config('db.database'));
        // Check connection
        if ($this->_con->connect_error) {
            die('Connect Error (' . $this->_con->connect_errno . ') '
                . $this->_con->connect_error);
        }
    }

    /**
     * Vergleiche User eingegebene Useranmeldedaten mit den aus der Datenbank
     * @param String $user
     * @param String $password
     * @return array|null
     */
    public function compare_user_credentials(String $user, String $password)
    {
        $pw_encoded = md5($password);
        $sql = "SELECT id, name FROM user WHERE name='" . $user . "' AND password='" . $pw_encoded . "';";
        $parsed = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $parsed = $this->get_as_array($result);
        }
        if (count($parsed) == 0) {
            return null;
        } else {
            return $parsed;
        }
    }

    /**
     * Erhalte alle Tische
     * @return array
     */
    public function get_tables()
    {
        $sql = "SELECT * FROM tisch";
        $tables = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $tables = $this->get_as_array($result);
        }
        return $tables;
    }

    /**
     * Erhalte alle Gerichte
     * gefiltert nach gesetzter Sprache
     */
    public function get_gerichte()
    {
        $sql = "SELECT g.id, g.preis, gd.name, gd.beschreibung, k.name as 'kategorie'
                FROM gericht g
                LEFT JOIN kategorie k on g.kategorie_id = k.id
                LEFT JOIN gericht_details gd on g.id = gd.gericht_id
                WHERE gd.lang = '" . $_SESSION['lang'] . "';";
    }

    /**
     * Erhalte alle Gerichte mit Kategorie_id
     * gefiltert nach gesetzter Sprache
     * @param $kategorie_id
     */
    public function get_gerichte_by_kategorie($kategorie_id)
    {
        $sql = "SELECT g.id, g.preis, gd.name, gd.beschreibung, k.name as 'kategorie'
                FROM gericht g
                LEFT JOIN kategorie k on g.kategorie_id = k.id
                LEFT JOIN gericht_details gd on g.id = gd.gericht_id
                WHERE gd.lang = '" . $_SESSION['lang'] . "' 
                AND k.lang = '" . $_SESSION['lang'] . "' AND k.id = " . $kategorie_id . ";";
    }

    /**
     * Erhalte alle Kategorien
     * gefiltert nach gesetzter Sprache
     */
    public function get_kategorien()
    {
        $sql = "SELECT *
                FROM kategorie
                WHERE lang = '" . $_SESSION['lang'] . "';";
    }

    /**
     * Parse MYSQL Ergebnisse als Array
     * @param $sql_results
     * @return array
     */
    private function get_as_array($sql_results)
    {
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
