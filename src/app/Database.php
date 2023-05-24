<?php

namespace App;

use PDO;

/**
 * Database Singleton class which allow us to use DB in our application.
 */
class Database {
    protected static $instance = null;

    private function __construct(){}

    /**
     * @return PDO
     * Retrieve instance of Database which allow us to make requests to the DB.
     */
    static function getInstance(): PDO {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.';', DB_USER, DB_PASS);
        }
        return self::$instance;
    }
}