<?php

namespace Framework;

class Registry {

    private static $_instance = null;
    private $_data;

    private function __construct() {
        
    }

    public static function getInstance() {

        if (!self::$_instance != null) {
            self::$_instance = new Registry();
        }
        return self::$_instance;
    }

    public function __set($key, $val) {
        $this->_data[$key] = $val;
    }

    public function __get($key) {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }
        return false;
    }

}

