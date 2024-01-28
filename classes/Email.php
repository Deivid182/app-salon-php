<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email{

  public $email;
  public $name;
  public $code;

  public function __construct($email, $name, $code){
    $this->email = $email;
    $this->name = $name;
    $this->code = $code;
  }

  public function sendEmail(){
    $phpmailer = new PHPMailer(true);
    try {
      $phpmailer->isSMTP();
      $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
      $phpmailer->SMTPAuth = true;
      $phpmailer->Port = 2525;
      $phpmailer->Username = 'ea958c08edb02d';
      $phpmailer->Password = 'e9e08763319f7e';

      $phpmailer->setFrom('accounts@appsalon.com');
      $phpmailer->addAddress('accounts@appsalon.com', 'AppSalon');
      $phpmailer->Subject = 'Verify your email';
      $phpmailer->isHTML(true);
      $phpmailer->CharSet = 'UTF-8';
      $content = "<html>";
      $content .= "Here is your verification code: {$this->code}";
      $content .= "Hi there!" . $this->name . "You've successfully created an account.";
      $content .= "Follow the next link to verify your account";
      $content .= "<a href='http://localhost:3000/verify-account?code={$this->code}'>Click here</a>";
      $content .= "</html>";

      $phpmailer->Body = $content;
      $phpmailer->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }

  }
}
