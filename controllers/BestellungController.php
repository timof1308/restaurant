<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 26.09.18
 * Time: 18:25
 */

namespace App;


class BestellungController
{
    static function showTables()
    {
        $db = new DatabaseController();
        $tables = $db->get_tables();
        include dirname(__FILE__) . './../pages/tisch_auswahl.php';
        return true;
    }

    static function getTable($table_id)
    {
        $db = new DatabaseController();
        $table = $db->get_table($table_id)[0];
        include dirname(__FILE__) . './../pages/bestellung.php';
        return true;
    }
}
