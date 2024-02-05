<?php

namespace Controllers;

use Model\Service;
use MVC\Router;

class ApiController {

  public static function index(Router $router) {
    $services = Service::all();
    echo json_encode($services);
  }
}
?>