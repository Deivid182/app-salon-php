<?php

namespace Controllers;

use Model\Appointment;
use Model\AppointmentService;
use Model\Service;
use MVC\Router;

class ApiController {

  public static function index(Router $router) {
    $services = Service::all();
    echo json_encode($services);
  }
  public static function saveAppointment() {
    $appointment = new Appointment($_POST);
    $result = $appointment->save();

    $id = $result['id'];

    $idServices = explode(',', $_POST['services']);

    // echo json_encode($id);

    // return;
    foreach ($idServices as $idService) {
      $args = [
        'appointmentId' => $id,
        'serviceId' => $idService
      ];
      $appointmentService = new AppointmentService($args);
      $appointmentService->save();
    };

    $response = [
      'result' => $result
    ];

    echo json_encode($response);
  }
}
?>