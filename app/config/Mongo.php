<?php
/**
 * Created by PhpStorm.
 * User: nishanth
 * Date: 14/11/19
 * Time: 10:37 PM
 */

namespace app\config;

use MongoDB;


class Mongo implements Singleton
{
    private $_connection;
    private static $_instance; //The single instance

    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $this->_connection = (new MongoDB\Client)->local->hotels;
    }

    private function __clone() { }

    public function getConnection() {
        return $this->_connection;
    }

}