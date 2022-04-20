<?php
namespace Framework59;

use Framework59\Database;

class Model {
    protected $conn;
    protected static $table;

    public function __construct() {
        $this->conn = new Database();
    }

    public static function where() {
        return 'test';
    }

    public static function get() {
        return self::$conn->resultSet();
    }

    public static function all() {
        $instance = new self();
        $instance->conn->query('SELECT * FROM ' . self::$table);
        if(empty($instance->conn->resultSet())) {
            if(!config['DEBUG_MODE']) return;
            Core::send500(['[Framework59] No result found in ' . self::$table . '(' . 'SELECT * FROM ' . self::$table . ')']);
            return;
        }
        return $instance->conn->resultSet();
    }

    
}
