<?php

namespace Controllers;
use MVC\Router;

class AppointmentController
{
  public function __construct()
  {
  }
  public static function index(Router $router) {
    session_start();
    
    $router->render('appointment/index', [
      "name" => $_SESSION['fullName']
    ]);
  }
}