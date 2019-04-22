<?php

require('php/inc/connect.php');

session_start();

$request = $_SERVER['REDIRECT_URL'];

switch ($request) {

    // Messenger page / main page will redirect if not logged in
    case '/' :
        require __DIR__ . '/views/messenger.php';
        break;

    // Login/logout
    case '/login' :
        require __DIR__ . '/views/login.php';
        break;
    case '/logout' :
        require __DIR__ . '/php/logout.php';
        break;

    // Register
    case '/register' :
        require __DIR__ . '/views/register.php';
        break;

    // Passwords
    case '/password' :
        require __DIR__ . '/views/password.php';
        break; 
    case '/password/reset' :
        require __DIR__ . '/views/reset.html';
        break; 
    case '/password/change' :
        require __DIR__ . '/views/change.php';
        break; 

    case '/user' :
        require __DIR__ . '/views/user.php';
        break; 

    case '/settings' :
        require __DIR__ . '/views/settings.php';
        break; 

    case '/files' :
        require __DIR__ . '/views/files.php';
        break; 

    case '/admin' :
        require __DIR__ . '/views/admin.php';
        break; 
    
    default:
        require __DIR__ . '/views/404.html';
        break;
}