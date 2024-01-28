<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController {
  public static function login(Router $router) {
    $alerts = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new User($_POST);
      $alerts = $auth->validateLogin();
      if(empty($alerts)) {
        $user = User::findUserByColumn('email', $auth->email);
        if($user) {
          if($user->matchPassword($auth->password)) {
            session_start();
            $_SESSION['id'] = $user->id;
            $_SESSION['email'] = $user->email;
            $_SESSION['fullName'] = $user->firstName . ' ' . $user->lastName;
            if($user->admin === "1") {
              $_SESSION['admin'] = $user->admin ?? null;
              header('Location: /admin');
            } else {
              header('Location: /appointment');
            }
          }
        } else {
          User::setAlert('error', 'User not found');
        }
      }
    }
    $alerts = User::getAlerts();
    $router->render('auth/login', [
      'alerts' => $alerts
    ]);
  }

  public static function logout() {
  }

  public static function forgotPassword(Router $router) {
    $router->render('auth/forgot-password');
  }

  public static function recoverPassword() {
    echo "Controller recover Password";
  }

  public static function register(Router $router) {
    $user = new User;
    $alerts = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user->syncUp($_POST);
      $alerts = $user->validateAccount();
      if(empty($alerts)) {

        $result = $user->userExists();
        if($result->num_rows) {
          $alerts = User::getAlerts();
        } else {
          $user->hashPassword();
          $user->createVerificationCode();
          $email = new Email($user->email, $user->firstName, $user->token);
          $email->sendEmail();
          $result = $user->save();
          if($result) {
            header('Location: /message');
          }
        }
      }
    }
    $router->render('auth/register', [
      'user' => $user,
      'alerts' => $alerts
    ]);
  } 
  public static function message (Router $router) {
    $router->render('auth/message');
  }

  public static function verify (Router $router) {
    $alerts = [];
    $token = s($_GET['code']);
    $user = User::findUserByColumn('token', $token);
    if(empty($user)) {
      User::setAlert('error', 'Invalid token');
    } else {
      $user->verified = "1";
      $user->token = null;
      $user->save();
      User::setAlert('success', 'Account verified successfully');
    }
    $alerts = User::getAlerts();
    $router->render('auth/verify-account', [
      'alerts' => $alerts 
    ]);
  }
} 