<?php

namespace Framework;

final class Database {
    /*
     * Database configuration
     */

    private static $_server = 'localhost';
    private static $_username = 'root';
    private static $_password = '';
    private static $_database_name = 'rols';
    /*
     * End of the database configuration
     */
    private static $_instance = null;

    private function __construct() {
        self::connect();
    }

    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new \Framework\Database();
        }
        return self::$_instance;
    }

    private static function connect() {
        \mysql_connect(self::$_server, self::$_username, self::$_password);
        \mysql_select_db(self::$_database_name);
    }

}

