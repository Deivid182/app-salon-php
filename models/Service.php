<?php

namespace Model;

class Service extends ActiveRecord {
  protected static $table = 'services';
  protected static $columnsDB = ['id', 'name', 'price'];

  public $id;
  public $name;
  public $price;

  public function __construct($args = []){
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->price = $args['price'] ?? '';
  }

  public function validate () {
    if(!$this->name) {
      self::$alerts["error"][] = "The name is required";
    }
    if(!$this->price) {
      self::$alerts["error"][] = "The price is required";
    }
    if(!is_numeric($this->price)) {
      self::$alerts["error"][] = "The price must be a number";
    }

    return self::$alerts;
  }
}