<?php

namespace Framework;

abstract class Base_Controller {

    protected $_registry;
    protected $load;

    public function __construct() {
        $this->_registry = Registry::getInstance();
        $this->load = new Load;
    }

    final public function __get($key) {
        $return = $this->_registry->$key;
        if ($return != false) {
            return $return;
        }
        return false;
    }

}

