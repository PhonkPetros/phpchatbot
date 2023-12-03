<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $username = filter_var($username);
        $password = filter_var($password);

        $pdo = $this->db->getConn();
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}


