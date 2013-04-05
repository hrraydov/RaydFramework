<?php

namespace Framework;

class App {

    private static $_instance = null;
    /*
     * Autoload 
     * configuration
     */
    private static $_autoload = array('App.php', 'Base_Controller.php', 'Base_Model.php', 'Load.php', 'Registry.php', 'Database.php', 'Validation.php');

    private function __construct() {
        
    }

    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new \Framework\App();
        }
        return self::$_instance;
    }

    public function run() {
        self::_autoload(self::$_autoload);
        $load = new \Framework\Load();
        $load->view('layouts/header', array('title' => 'ROLS'));
        if (isset($_GET['url'])) {

            if(isset($_GET['c'])){
				$c=$_GET['c'];
			}
			else{
				$c='Home';
			}
			if(isset($_GET['a'])){
				$a=$_GET['a'];
			}
			else{
				$a='index';
			}
			
        } else {
            $c = 'Home';
            $a = 'index';
        }
        if (\count($_POST) > 0) {
            $registry = \Framework\Registry::getInstance();
            $registry->post = $_POST;
        }
        if (\count($_GET) > 1) {
            $registry = \Framework\Registry::getInstance();
            $registry->get = $_GET;
        }

        $this->_loadControllerAndAction($c, $a);
        $load->view('layouts/footer');
    }

    private static function _autoload($data) {
        foreach ($data as $value) {
            require_once 'Core' . DIRECTORY_SEPARATOR . $value;
        }
    }

    private function _loadControllerAndAction($controller_name, $action_name) {
        if (!\file_exists('Controllers' . DIRECTORY_SEPARATOR . $controller_name . '_Controller.php')) {
            die('Ne sashtestvuva takav controller' . $controller_name);
        }
        require_once 'Controllers' . DIRECTORY_SEPARATOR . $controller_name . '_Controller.php';
        $controller_name.='_Controller';
        if (!\class_exists($controller_name)) {
            die('Ne sashtestvuva takav controller');
        }
        $$controller_name = new $controller_name();
        if (!\method_exists($$controller_name, $action_name)) {
            die('Ne sashtestvuva takav method');
        }
        $$controller_name->$action_name();
    }

}

