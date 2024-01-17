<?php
require_once './controllers/UserController.php';
require_once './models/User.php';

class RegisterController {
    public function show() {

    $error = 'Password is not the same or the user';

    $result = true;

    $users = new UserController();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password_input'];
            $confirmPassword = $_POST['confirm_password_input'];

            if ($password != $confirmPassword) {
                $error = 'Passwords do not match';
                $result = false;
            }else if ($users->getUsername($username)) {
                $error = 'Username already exists';
                $result = false;
            }
            else
            {
                $user = new User();
                $user->setUsername($username);
                $user->setPassword($password);
                
                $result = $users->register($user); 
                header('Location: ./');
            }
        }

        require __DIR__ . '/../views/register.php';
    }
}