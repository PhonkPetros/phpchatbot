<?php

$request = $_SERVER['REQUEST_URI'];



switch ($request) {

    case '/' :
        require __DIR__ . '/./views/login.php';
        break;
    case '/register' :
        require __DIR__ . '/./views/register.php';
        break;
    case '/chat' :
        require __DIR__ . '/./views/chat.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/./views/404.php';
        break;
}

?>