<?php
/**
 * Created by PhpStorm.
 * User: timo
 * Date: 20.09.18
 * Time: 22:29
 */

namespace App;


class TestController
{
    static function json()
    {
        $array = array(
            array("id" => 1,
                "name" => "John Doe",
                "email" => "john.doe@gmail.com",
                "group" => array(
                    "id" => 1,
                    "group" => "Admin"
                )
            ),
            array("id" => 2,
                "name" => "Jane Smith",
                "email" => "jane.smith@gmail.com",
                "group" => array(
                    "id" => 2,
                    "group" => "User"
                )),
        );

        return json($array);
    }

    static function config()
    {
        translate('nav.home');
        return true;
    }

    static function regex($id) {
        echo $id;
    }

    static function test() {
        return json(Auth::name());
    }
}
