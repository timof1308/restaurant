<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 26.09.18
 * Time: 20:12
 */

namespace App;


class KuechenController
{
    static function index()
    {
        self::check_auth();

        $db = new DatabaseController();
        $tables = $db->get_tables();
        include dirname(__FILE__) . './../pages/kueche.php';
        return true;
    }

    static function get_tische() {
        $db = new DatabaseController();
        $tables = $db->get_tables();
        return json($tables);
    }

    static function get_order_by_table($table_id) {
        $db = new DatabaseController();
        $tables = $db->get_open_order_by_table($table_id);
        return json($tables);
    }

    static function get_gerichte()
    {
        $db = new DatabaseController();
        $gerichte = $db->get_gerichte();
        return json($gerichte);
    }

    static function get_kategorien()
    {
        $db = new DatabaseController();
        $kategorien = $db->get_kategorien();
        return json($kategorien);
    }

    static function get_gerichte_by_kategorie($kategorie_id)
    {
        $db = new DatabaseController();
        $gerichte = $db->get_gerichte_by_kategorie($kategorie_id);
        return json($gerichte);
    }

    static function check_auth()
    {
        if (!Auth::check()) {
            flash("<i class='fas fa-exclamation-triangle'></i> " . translate('login.required'), 'warning');
            header('Location: ' . config('server.protocol') . $_SERVER['HTTP_HOST'] . config('server.base_url') . '/login');
            return null;
        }
    }
}
