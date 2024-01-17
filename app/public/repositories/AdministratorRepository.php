<?php 
require_once "database.php";

class AdministratorRepository extends Database {


    public function removeUser($username) {
        $sql = "DELETE FROM users WHERE username = ?";
        return $this->executeQuery($sql, [$username]);
    }

    public function updatePassword($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        return $this->fetchSingle($sql, [$username]);
    }

    public function promoteUser($username) {
        $sql = "UPDATE users SET role = 'Administrator' WHERE username = ?";
        return $this->executeQuery($sql, [$username]);
    }

    public function demoteUser($username) {
        $sql = "UPDATE users SET role = 'User' WHERE username = ?";
        return $this->executeQuery($sql, [$username]);
    }
    

    public function getAdminByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ? and role = 'Administrator'";
        return $this->fetchSingle($sql, [$username]);
    }

    public function getAllUsersWithQueries() {
        $sql = "SELECT u.id, u.username, u.password, u.role, IFNULL(q.query_count, 0) AS query_count, q.query_date 
                FROM users u
                LEFT JOIN (
                    SELECT user_id, COUNT(*) AS query_count, MAX(query_date) AS query_date
                    FROM queries
                    GROUP BY user_id
                ) q ON u.id = q.user_id";
    
        return $this->fetchAll($sql);
    }
    
}

