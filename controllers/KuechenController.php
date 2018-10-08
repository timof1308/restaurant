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
    /**
     * Kuechen Ansicht / Dashboard
     * @return bool
     */
    static function index()
    {
        self::check_auth();

        $db = new DatabaseController();
        $tables = $db->get_tables();
        include dirname(__FILE__) . './../pages/kueche.php';
        return true;
    }

    /**
     * Tischauswahl Ansicht
     * @return bool
     */
    static function get_tische()
    {
        $db = new DatabaseController();
        $tables = $db->get_tables();
        return json($tables);
    }

    /**
     * Offene Bestellung für Tisch ID erhalten
     * @param $table_id
     * @return bool
     */
    static function get_order_by_table($table_id)
    {
        $db = new DatabaseController();
        $order = $db->get_open_order_by_table($table_id);
        if (count($order) > 0) {
            $order = $order[0];
        } else {
            $order = null;
        }
        return json($order);
    }

    /**
     * Alle Gerichte erhalten
     * @return bool
     */
    static function get_gerichte()
    {
        $db = new DatabaseController();
        $gerichte = $db->get_gerichte();
        return json($gerichte);
    }

    /**
     * Alle Kategorien erhalten
     * @return bool
     */
    static function get_kategorien()
    {
        $db = new DatabaseController();
        $kategorien = $db->get_kategorien();
        return json($kategorien);
    }

    /**
     * Alle Gerichte für Kategorie ID erhalten
     * @param $kategorie_id
     * @return bool
     */
    static function get_gerichte_by_kategorie($kategorie_id)
    {
        $db = new DatabaseController();
        $gerichte = $db->get_gerichte_by_kategorie($kategorie_id);
        return json($gerichte);
    }

    /**
     * Neue Bestellung erstellen
     * @return bool
     */
    static function create_order()
    {
        $table_id = $_POST['table_id'];
        $db = new DatabaseController();
        $bestell_id = $db->create_order($table_id);
        return json(array('id' => $bestell_id));
    }

    /**
     * Neue Bestellung Position erstellen
     * @return bool
     */
    static function create_position()
    {
        $bestellung_id = $_POST['bestellung_id'];
        $gericht_id = $_POST['gericht_id'];
        $comment = $_POST['comment'];
        $platz_nr = $_POST['platz_nr'];
        $kategorie_id = $_POST['kategorie_id'];

        $data = array(
            'bestellung_id' => $bestellung_id,
            'gericht_id' => $gericht_id,
            'comment' => $comment,
            'platz_nr' => $platz_nr,
        );

        $db = new DatabaseController();
        $position_id = $db->create_position($bestellung_id, $gericht_id, $platz_nr, $comment);
        return json(array(
            'id' => $position_id,
            'gericht_id' => $gericht_id,
            'kategorie_id' => $kategorie_id
        ));
    }

    /**
     * Erhalte Gericht für ID
     * @param $gericht_id
     * @return bool
     */
    static function get_gericht($gericht_id)
    {
        $db = new DatabaseController();
        $gericht = $db->get_gericht($gericht_id);
        return json($gericht);
    }

    /**
     * Widerruft eine bestellposition
     * @param $position_id
     * @return bool
     */
    static function revoke_position($position_id)
    {
        $db = new DatabaseController();
        $revoke = $db->revoke_position($position_id);
        return json($revoke);
    }

    /**
     * Positionen zu Order ID erhalten
     * @param $order_id
     * @return bool
     */
    static function get_positions_by_order($order_id)
    {
        $db = new DatabaseController();
        $positions = $db->get_positions_from_order($order_id);
        return json($positions);
    }

    /**
     * Bestell Status ändern
     * @param $order_id
     * @return bool
     */
    static function update_order_status($order_id)
    {
        $status = $_POST['status'];
        $db = new DatabaseController();
        $update = $db->udpate_order_status($order_id, $status);
        return json(array('update' => $update));
    }

    /**
     * Bestellung zum Zahlen bereit
     * @param $order_id
     */
    static function paying_order($order_id)
    {
        $db = new DatabaseController();
        $update = $db->udpate_order_status($order_id, 2);
        header('Location: ' . config('server.bill_url') . $order_id, true, 301);
        exit();
    }

    /**
     * Bestellung nach Bezahlung abschließen
     * Weiterleitung zur Küchenansicht
     * @param $order_id
     */
    static function order_payed($order_id) {
        $db = new DatabaseController();
        $update = $db->udpate_order_status($order_id, 3);
        flash("<i class='fas fa-info-circle'></i> Bezahlung abgeschlossen", 'info');
        header('Location: ' . config('server.protocol') . $_SERVER['HTTP_HOST'] . config('server.base_url') . '/kueche', true, 301);
        exit();
    }

    /**
     * Weiterleitung zum einsehen der Rechnung
     * @param $oder_id
     */
    static function view_bill($oder_id) {
        header('Location: ' . config('server.bill_url'). $oder_id, true, 301);
        exit();
    }

    /**
     * Überprüfen ob User angemeldet ist oder nicht
     * @return null
     */
    static function check_auth()
    {
        if (!Auth::check()) {
            // weiterleiten zur anmeldeseite
            flash("<i class='fas fa-exclamation-triangle'></i> " . translate('login.required'), 'warning');
            header('Location: ' . config('server.protocol') . $_SERVER['HTTP_HOST'] . config('server.base_url') . '/login', true, 301);
            exit();
        }
        return true;
    }
}
