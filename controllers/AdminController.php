<?php

namespace Controllers;

use Model\AdminAppointment;
use MVC\Router;

class AdminController
{
  public static function index(Router $router)
  {
    session_start();
    isAdmin();
    $date = $_GET['date'] ?? date('Y-m-d');
    $newDate = explode('-', $date);
    if(!checkdate($newDate[1], $newDate[2], $newDate[0])){
      header('Location: /404');
    }
    $query = "SELECT appointments.id, appointments.`time`, CONCAT(users.firstName,' ', users.lastName) as fullname, ";
    $query .= " users.email, users.phone, services.name as service, services.price ";
    $query .= " FROM appointments ";
    $query .= " LEFT OUTER JOIN users ";
    $query .= " ON appointments.userId=users.id  ";
    $query .= " LEFT OUTER JOIN appointmentsServices ";
    $query .= " ON appointmentsServices.appointmentId=appointments.id ";
    $query .= " LEFT OUTER JOIN services ";
    $query .= " ON services.id = appointmentsServices.serviceId ";
    $query .= " WHERE appointments.`date` = '$date' ";

    $appointments = AdminAppointment::customSQL($query);

    $router->render('admin/index', [
      'name' => $_SESSION['fullName'],
      'appointments' => $appointments,
      'currentDate' => $date
    ]);
  }

  public static function delete()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $adminAppointment = AdminAppointment::find($id);
      $adminAppointment->delete();
    }
  }
}