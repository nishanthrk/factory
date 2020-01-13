<?php
/**
 * Created by PhpStorm.
 * User: nishanth
 * Date: 14/11/19
 * Time: 8:07 PM
 */

namespace app\config;

use mysqli;

class Mysql implements Singleton
{
    private $_connection;
    private static $_instance; //The single instance
    private $_host = '127.0.0.1';
    private $_port = 3306;
    private $_username = "root";
    private $_password = "nishanth";
    private $_database = "le";

    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {

        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database, $this->_port);

        if ($this->_connection->connect_error) {
            trigger_error($this->_connection->connect_error, E_USER_ERROR);
        }

    }

    private function __clone() { }

    public function getConnection() {
        return $this->_connection;
    }

}