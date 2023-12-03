<?php

require_once 'database.php';

class Users {
    private $db; 


    public function __construct() {
        $this->db = new Database();
    }

    public function register($username, $password, $confirmPassword) {

        if ($password !== $confirmPassword) {
            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, 'User')";
        $params = [$username, $hashedPassword];

        $stmt = $this->db->executeQuery($sql, $params);

        if ($stmt) {
            header("Location: index.php");
            return true;
            exit;
        } else {
            echo "Registration False";
            return false;
        }
    }
}

?>
