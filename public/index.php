<?php

require_once 'env.php';

require_once './src/controller/AuthController.php';
require_once './src/controller/CategoryController.php';
require_once './src/controller/AccountController.php';

use controller\AuthController;
use controller\CategoryController;
use controller\AccountController;

$url = parse_url($_SERVER['REQUEST_URI']);

$path = $url['path'] ?? '/';

session_start();

switch($path){
    case $path === "/":
        echo "Homepage";
        break;
    case $path === "/auth" :
        echo new AuthController()->render();
        break;
    case $path === "/category" :
        echo new CategoryController()->render();
        break;
    case $path === "/account" :
        echo new AccountController()->render();
        break ;
    default:
        echo "Page not found";
        break;
}


