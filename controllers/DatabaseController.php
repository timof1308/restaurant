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
     * Erhalte Tisch Informationen
     * @param $id
     * @return array
     */
    public function get_table($id)
    {
        $sql = "SELECT * FROM tisch WHERE id = '" . $id . "';";
        $table = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $table = $this->get_as_array($result);
        }
        return $table;
    }

    /**
     * Erhalte alle Gerichte
     * gefiltert nach gesetzter Sprache
     */
    public function get_gerichte()
    {
        $sql = "SELECT g.id, g.preis, gd.name, gd.beschreibung, k.id as 'kategorie_id', k.name as 'kategorie'
                FROM gericht g
                LEFT JOIN kategorie k on g.kategorie_id = k.id
                LEFT JOIN gericht_details gd on g.id = gd.gericht_id
                WHERE gd.lang = '" . $_SESSION['lang'] . "' 
                AND k.lang = '" . $_SESSION['lang'] . "';";
        $dishes = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $dishes = $this->get_as_array($result);
        }
        return $dishes;
    }

    /**
     * Erhalte alle Gerichte mit Kategorie_id
     * gefiltert nach gesetzter Sprache
     * @param $kategorie_id
     * @return array
     */
    public function get_gerichte_by_kategorie($kategorie_id)
    {
        $sql = "SELECT g.id, g.preis, g.bild, gd.name, gd.beschreibung, k.name as 'kategorie', k.id as 'kategorie_id'
                FROM gericht g
                LEFT JOIN kategorie k on g.kategorie_id = k.id
                LEFT JOIN gericht_details gd on g.id = gd.gericht_id
                WHERE gd.lang = '" . $_SESSION['lang'] . "' 
                AND k.lang = '" . $_SESSION['lang'] . "' AND k.id = " . $kategorie_id . ";";
        $dishes = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $dishes = $this->get_as_array($result);
        }
        return $dishes;
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
        $categories = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $categories = $this->get_as_array($result);
        }
        return $categories;
    }

    /**
     * Erhalte offene Bestellung für Tisch ID
     * @param $table_id
     * @return array
     */
    public function get_open_order_by_table($table_id)
    {
        $sql = "SELECT *
                FROM tisch t
                LEFT JOIN bestellung b on t.id = b.tisch_id
                WHERE t.id = '" . $table_id . "' AND b.status = 0;";
        $order = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $order = $this->get_as_array($result);
        }
        return $order;
    }

    /**
     * Erhalte Rechnungspositionen für eine Bestellung
     * @param $order_id
     * @return array
     */
    public function get_positions_from_order($order_id)
    {
        $sql = "SELECT *
                FROM bestellung b
                LEFT JOIN position p on b.id = p.bestellung_id
                WHERE b.id = '" . $order_id . "' AND b.status = 0;";
        $positions = array();
        if ($result = mysqli_query($this->_con, $sql)) {
            $positions = $this->get_as_array($result);
        }
        return $positions;
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
