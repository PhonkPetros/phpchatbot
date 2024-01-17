<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    
    case '/':
        require_once 'controllers/LoginController.php';
        $controller = new LoginController();
        $controller->show();
        break;

    case '/login':
        require_once 'controllers/LoginController.php';
        $controller = new LoginController();
        $controller->login();
        break;

    case '/register':
        require_once 'controllers/RegisterController.php';
        $controller = new RegisterController();
        $controller->show();
        break;
    case '/chat':
        require_once 'controllers/ChatController.php';
        $controller = new ChatController();
        $controller->show();
        break;
    case '/administrator':
        require_once 'controllers/AdministratorController.php';
        $controller = new AdministratorController();
        $controller->show();
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
?>

