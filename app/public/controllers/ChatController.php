<?php
class ChatController {
    public function show() {
        
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
          session_unset();
          session_destroy();
          header('Location: /');
          exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['administrator'])) {
            header('Location: /administrator');
            exit;
        }

        require __DIR__ . '/../views/chat.php';
    }
}
