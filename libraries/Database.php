<?php

namespace Framework59;

use PDO;
use PDOException;


class Database {

    private $dbHost = config['DB_HOST'];
    private $dbUser = config['DB_USER'];
    private $dbPass = config['DB_PASS'];
    private $dbName = config['DB_NAME'];
    
    private $statement;
    private $conn;
    private $error;

    public function __construct() {
        $connection = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->conn = new PDO($connection, $this->dbUser, $this->dbPass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Queries uitvoeren
    public function query($sql) {
        $this->statement = $this->conn->prepare($sql);
    }

    // Bind waardes
    public function bind($parameter, $value, $type = null) {
        // Kijkt of $type een integer, boolean, null of string is
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
            $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($parameter, $value, $type);
    }

    // Execute prepared statement
    public function execute() {
        return $this->statement->execute();
    }

    // Return array 
    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Return een specifiek rij uit de database
    public function single() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // Aantal rijen gevonden
    public function rowCount() {
        return $this->statement->rowCount();
    }
}

