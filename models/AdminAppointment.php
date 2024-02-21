<?php

namespace Model;
class AdminAppointment extends ActiveRecord {
  protected static $table = 'appointmentsServices';
  protected static $columnsDB = ['id', 'fullname', 'time', 'email', 'phone', 'service', 'price'];

  public $id;
  public $fullname;
  public $time;
  public $email;
  public $phone;
  public $service;
  public $price;

  public function __construct($args = []) {
    $this->id = $args['id'] ?? null;
    $this->fullname = $args['fullname'] ?? '';
    $this->time = $args['time'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->service = $args['service'] ?? '';
    $this->price = $args['price'] ?? '';
  }
}