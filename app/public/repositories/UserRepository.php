<?php
require_once "database.php";

class UserRepository extends Database {

    public function registerUser($username, $hashedPassword) {
        
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, 'User')";
        return $this->executeQuery($sql, [$username, $hashedPassword]);
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ? and role = 'User'";
        return $this->fetchSingle($sql, [$username]);
    }

    public function deleteUser($username) {
        $sql = "DELETE FROM users WHERE username = ?";
        return $this->fetchSingle($sql, [$username]);
    }
}

