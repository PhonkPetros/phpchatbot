<?php

class UserModel {
    
    protected string $username;
    protected string $password;
    protected string $role;
    protected int $query_count;


    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = filter_var($username);
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = 'User';
    }

    public function getQueryCount() {
        return $this->query_count;
    }

    public function setQueryCount($query_count) {
        $this->query_count = filter_var($query_count, FILTER_SANITIZE_NUMBER_INT);
    }
}


