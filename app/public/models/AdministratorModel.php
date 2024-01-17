<?php 
require_once __DIR__ . '/UserModel.php';

class AdministratorModel extends UserModel {

    public function setRole($role) {
        $this->role = 'Administrator';
    }

    
}

?>