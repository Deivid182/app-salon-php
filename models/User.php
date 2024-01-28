<?php 

namespace Model;
class User extends ActiveRecord {

  protected static $table = 'users';
  protected static $columnsDB = ['id', 'firstName', 'lastName', 'email', 'password', 'phone', 'token', 'verified', 'admin'];
  public $id;
  public $firstName;
  public $lastName;
  public $email;
  public $password;
  public $phone;
  public $token;
  public  $verified;
  public $admin;

  public function __construct($args = []){
    $this->id = $args['id'] ?? null;
    $this->firstName = $args['firstName'] ?? '';
    $this->lastName = $args['lastName'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->verified = $args['verified'] ?? 0;
    $this->token = $args['token'] ?? '';
    $this->admin = $args['admin'] ?? 0;
  }

  //warnings for data register
  public function validateAccount( ) {
    if(!$this->firstName) {
      self::$alerts['error'][] = 'The first name is required';
    }
    if(!$this->lastName) {
      self::$alerts['error'][] = 'The last name is required';
    }
    if(!$this->phone) {
      self::$alerts['error'][] = 'The phone number is required';
    }
    if(!$this->email) {
      self::$alerts['error'][] = 'The email is required';
    }
    if(!$this->password) {
      self::$alerts['error'][] = 'The password is required';
    }
    if(strlen($this->password) < 6) {
      self::$alerts['error'][] = 'The password must be at least 6 characters';
    }
    return self::$alerts;
  }
  public function validateLogin() {
    if(!$this->email) {
        self::$alerts['error'][] = 'The email is required';
    }
    if(!$this->password) {
        self::$alerts['error'][] = 'The password is required';
    }

    return self::$alerts;
}

  public function userExists() {
    $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";
    $result = self::$db->query($query);
    if($result->num_rows) {
      self::$alerts['error'][] = 'The email is already registered';
    }
    return $result;
  }

  public function hashPassword() {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }
  public function createVerificationCode() {
    $this->token = uniqid();
  }
  public static function findUserByColumn($column, $value) {
    $res = self::where($column, $value);
    return $res ? new User((array)$res) : null;
  }

  public function matchPassword($password) {
    $result = password_verify($password, $this->password);
    if(!$result || !$this->verified) {
      self::$alerts['error'][] = 'Invalid credentials or not verified';
    } else {
      return true;
    }
  }
}