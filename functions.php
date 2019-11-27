<?php 

// Load Composer's autoloader
require 'vendor/autoload.php';

// Load config
require_once 'config.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




function detectPage()
{
  $uri = $_SERVER['REQUEST_URI'];
  $parts = explode('/', $uri);
  $fileName = $parts[2];
  $parts = explode('.', $fileName);
  $page = $parts[0];
  return $page;
}

function findUserByEmail($email)
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute(array($email));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function findUserById($id)
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->execute(array($id));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function sendEmail($to, $name, $subject, $content)
{
  global $EMAIL_NAME, $EMAIL_USERNAME, $EMAIL_PASSWORD;

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  //Server settings
  $mail->isSMTP();                                            // Send using SMTP
  $mail->CharSet    = 'UTF-8';
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = $EMAIL_USERNAME;                     // SMTP username
  $mail->Password   = $EMAIL_PASSWORD;                               // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
  $mail->Port       = 587;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom($EMAIL_USERNAME, $EMAIL_NAME);
  $mail->addAddress($to, $name);     // Add a recipient

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = $subject;
  $mail->Body    = $content;
  $mail->AltBody = $content;

  $mail->send();
  return true;
}