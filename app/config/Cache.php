<?php

namespace app\config;

use Redis ;

class Cache {
    private $_cache;
    private static $_instance; //The single instance
    private $_host;
    private $_port;
    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct() {
        $this->_host = getenv('REDIS_HOST') ? getenv('REDIS_HOST') : 'localhost';
        $this->_port = getenv('REDIS_PORT') ? getenv('REDIS_PORT') : 6379;

        $this->_cache = new Redis();
        $this->_cache->connect($this->_host, $this->_port) or die ("Could not connect");
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }

    // Get mysqli connection
    public function getConnection() {
        return $this->_cache;
    }
}