<?php
namespace Framework59;

use Framework59\Database;

class Model {
    protected static $conn;

    public function __construct() {
        self::$conn = new Database;
    }

    public static function where() {
        return self::$conn->query('SELECT * FROM ' . $this->table . 'WHERE')
    }

    public static function get() {
        return self::$conn->resultSet();
    }

    public static function all() {

    }

    public static function where() {

    }

    
}
