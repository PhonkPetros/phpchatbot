<?php 

class Database {
    private $servername = 'mysql';
    private $username = 'root';
    private $password = 'secret123';      
    private $database = 'constructionDB';  

    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit(); 
        }
    }

    public function getConn() {
        return $this->conn;
    }
    

    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
            exit();
        } catch (PDOException $e) {
            echo "Query execution error: " . $e->getMessage();
            return null;
        }
    }
    

    public function fetchSingle($sql, $params = []) {
        $stmt = $this->executeQuery($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll($sql, $params = []) {
        $stmt = $this->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastInsertedID() {
        return $this->conn->lastInsertId();
    }
}



