<?php

namespace Controllers;

use Model\Service;
use MVC\Router;

class ServiceController {
  public static function index (Router $router){
    
    session_start();

    isAdmin();

    $services = Service::all();

    $router->render('services/index', [
      "name" => $_SESSION['fullName'],
      "services" => $services
    ]); 
  }

  public static function create (Router $router){
    session_start();

    isAdmin();
    $service = new Service();
    $alerts = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service->syncUp($_POST);

      $alerts = $service->validate();

      if(empty($alerts)) {
        $service->save();
        header('Location: /services');
      }
    }
    $router->render('services/create', [
      "name" => $_SESSION['fullName'],
      "service" => $service,
      "alerts" => $alerts
    ]); 
  }

  public static function edit (Router $router) {

    session_start();
    isAdmin();
    $id = $_GET['id'];
    if(!$id || !is_numeric($id)) {
      header('Location: /services');
    }
    $service = Service::find($id);
    
    $alerts = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service->syncUp($_POST);
      $alerts = $service->validate();
      if(empty($alerts)) {
        $service->save();
        header('Location: /services');
      }
    }
    $router->render('services/edit', [
      "name" => $_SESSION['fullName'],
      "service" => $service,
      "alerts" => $alerts
    ]); 
  }

  public static function delete () {
    session_start();
    isAdmin();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $service = Service::find($id);
      $service->delete();
      header('Location: /services');
    }
  }
}