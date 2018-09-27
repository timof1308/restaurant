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
        include dirname(__FILE__) . './../pages/bestellung.php';
        return true;
    }

    static function placeOrder($table_id)
    {
        echo $table_id;
        return true;
    }
}
