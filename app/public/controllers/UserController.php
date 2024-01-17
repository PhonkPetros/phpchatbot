<?php
require_once './repositories/UserRepository.php';

class UserController {
    private $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function register(User $user) {

        if ($this->userRepo->getUserByUsername($user->getUsername())) {
            $error = 'Username already exists';
            return false;
        }
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);
    
        return $this->userRepo->registerUser($user->getUsername(), $user->getPassword());
    }

    public function getUsername($username) {
        return $this->userRepo->getUserByUsername($username);
    }

    public function selfDelete(User $user) {
        $username = $user->getUsername();
        return $this->userRepo->deleteUser($username);
    }

    public function loginUser($username, $password) {
        if ($username && $password == null){
            return false;
        }

        $user = $this->userRepo->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] == 'User') {
                return $user;
            }
        }

        return false;
    }
}

?>
