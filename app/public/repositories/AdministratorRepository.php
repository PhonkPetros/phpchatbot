<?php 
require_once "database.php";


class Administrator extends Database {

    public function removeUser($username, $hashedPassword) {
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, 'User')";
        return $this->executeQuery($sql, [$username, $hashedPassword]);
    }

    public function updatePassword($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        return $this->fetchSingle($sql, [$username]);
    }
    

}

