<?php
require_once './repositories/UserRepository.php';

class Users {
    private $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function register(User $user) {

        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);
    
        return $this->userRepo->registerUser($user->getUsername(), $user->getPassword());
    }
    

    public function loginEmployee($username, $password) {
        if ($username && $password == null){
            return false;
        }
        $user = $this->userRepo->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] == 'Administrator' || $user['role'] == 'User') {
                return $user;
            }
        }

        return false;
    }
}

?>
