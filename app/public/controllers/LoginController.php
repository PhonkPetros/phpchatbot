<?php
require_once './controllers/AdministratorController.php';
require_once './controllers/UserController.php';


class LoginController {
    private $userModel;
    private $adminModel;

    public function __construct() {
        $this->userModel = new UserController();
        $this->adminModel = new AdministratorController();
    }

    public function show() {
        require __DIR__ . '/../views/login.php';
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST);

            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');


            switch (true) {
                case $user = $this->userModel->loginUser($username, $password):
                    break;
                case $user = $this->adminModel->loginAdministrator($username, $password):
                    break;
            }

            if ($user != null) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: /chat');
                exit;
            } else {
                $error = "Invalid username or password";
            }
        }

        require __DIR__ . '/../views/login.php';
    }
}
