<?php

namespace Controllers;

use MVC\Router;

class LoginController {
  public static function login(Router $router) {
    $router->render('auth/login');
  }

  public static function logout() {
    echo "Controller Logout";
  }

  public static function forgotPassword() {
    echo "Controller Forgot Password";
  }

  public static function recoverPassword() {
    echo "Controller recover Password";
  }

  public static function register() {
    echo "Controller Register";
  } 
} 