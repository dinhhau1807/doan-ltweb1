<?php

// Load Composer's autoloader
//require 'vendor/autoload.php';

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

function createUser($displayName, $email, $password, $avatar, $background)
{
  global $db, $BASE_URL;
  $hashPassword = password_hash($password, PASSWORD_DEFAULT);
  $code = generateRandomString(16);
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $dateNow = date("Y-m-d");

  $stmt = $db->prepare("INSERT INTO users (displayName, email, password, avatarImage, backgroundImage, status, code, createdDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->execute(array($displayName, $email, $hashPassword, $avatar, $background, 0, $code, $dateNow));
  $id = $db->lastInsertId();

  $bodyContent = "Mã kích hoạt tài khoản của bạn là <strong>$code</strong><br />"
    . "Hoặc click vào <a href='$BASE_URL/activate.php?code=$code' target='_blank'>ĐÂY</a> để kích hoạt!";
  sendEmail($email, $displayName, 'Kích hoạt tài khoản', $bodyContent);
  return $id;
}

function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function activateUser($code)
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM users WHERE code=? AND status=?");
  $stmt->execute(array($code, 0));
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user && $user['code'] == $code) {
    $stmt = $db->prepare("UPDATE users SET code=?, status=? WHERE id=?");
    $stmt->execute(array('', 1, $user['id']));
    return true;
  }
  return false;
}

function sendCodeResetPassword($user)
{
  global $db, $BASE_URL;
  $code = generateRandomString(16);

  $stmt = $db->prepare("UPDATE users SET code=? WHERE id=?");
  $stmt->execute(array($code, $user['id']));

  $bodyContent = "Mã reset mật khẩu của bạn là <strong>$code</strong><br />"
    . "Hoặc click vào <a href='$BASE_URL/reset-password.php?code=$code' target='_blank'>ĐÂY</a> để reset mật khẩu!";
  sendEmail($user['email'], $user['displayName'], 'Reset mật khẩu', $bodyContent);
}

function checkValidCodeResetPassword($code)
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM users WHERE code=? AND status=?");
  $stmt->execute(array($code, 1));
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    return true;
  }
  return false;
}

function resetPassword($code, $password)
{
  global $db;
  $check = checkValidCodeResetPassword($code);
  if ($check) {
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE users SET code=?, password=? WHERE code=?");
    $stmt->execute(array('', $hashPassword, $code));
    return true;
  }
  return false;
}

function getNewFeeds()
{
  global $db;
  $stmt = $db->prepare("SELECT p.*, u.displayName FROM posts as p join users u on p.userId = u.id ORDER BY p.createdAt DESC");
  $stmt->execute();
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $posts;
}

function getAvatarImage($userId)
{
  global $db;
  $stmt = $db->prepare("SELECT avatarImage FROM users WHERE id = ?");
  $stmt->execute(array($userId));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getPostImage($postId)
{
  global $db;
  $stmt = $db->prepare("SELECT image FROM posts WHERE id = ?");
  $stmt->execute(array($postId));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Function create post
function createPost($userID, $Content, $image, $role)
{
  global $db;
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $dateNow = date("Y-m-d H:i:s");
  $stmt = $db->prepare("INSERT INTO posts (userId, createdAt, content, image, role) VALUES (?, ?, ?, ?,?)");
  $stmt->execute(array($userID, $dateNow, $Content, $image, $role));
  return $db->lastInsertId();
}


function findAllPosts($userId)
{
  $usr = $userId;
  global $db;
  $stmt = $db->prepare("SELECT  p.*,u.displayName,u.id as myImageID ,p.createdAt from ( SELECT * from posts where userId = ? union select * from posts where userId in (select userId2 from friendship where userID1= ?)
  and (role = 2 or role = 1) 
  ) p join users u on (p.userId = u.id) 
    ORDER BY p.createdAt DESC");
  $stmt->execute(array($userId,$usr));
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $posts;
}

function postsById($userId)
{
  global $db;
  $stmt = $db->prepare("SELECT p.*,u.displayName,u.id as myImageID ,p.createdAt FROM posts as p left join users as u on p.userId = u.id WHERE p.userId = ? ORDER BY p.createdAt DESC");
  $stmt->execute(array($userId));
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//POST PRIVACY
//Public Mode
function postsPublic($userId)
{
  global $db;
  $stmt = $db->prepare("SELECT p.*,u.displayName,u.id as myImageID ,p.createdAt FROM posts as p left join users as u on p.userId = u.id WHERE p.userId = ? and p.role = 1 ORDER BY p.createdAt DESC");
  $stmt->execute(array($userId));
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Friend Mode
function postsFriend($userId)
{
  global $db;
  $stmt = $db->prepare("SELECT p.*,u.displayName,u.id as myImageID ,p.createdAt FROM posts as p left join users as u on p.userId = u.id WHERE p.userId = ? and p.role = 2 ORDER BY p.createdAt DESC");
  $stmt->execute(array($userId));
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//Show post with relationship.
function showPosts($userId1,$userId2)
{
  if($userId1 == $userId2)
  {
      return postsById($userId1);
  }
  $user1 = findUserById($userId1);
  $user2 = findUserById($userId2);
  if ($user1['id'] != $userId1 || $user2['id'] != $userId2) {
    return "ID không tồn tại !";
  }
  $isFollowing  = getFriendShip($userId2, $userId1);
  $isFollower = getFriendShip($userId1, $userId2);
  $arrPosts = [];

  if ($isFollower && $isFollowing){
      $pstFriend = postsFriend($userId2);
      $pstPublic = postsPublic($userId2);
      $arrPosts = array_merge($arrPosts, $pstFriend);
      $arrPosts = array_merge($arrPosts, $pstPublic);
  }
  if (($isFollower && !$isFollowing) || (!$isFollower && $isFollowing) || (!$isFollower && !$isFollowing)){
    $pstPublic = postsPublic($userId2);
    $arrPosts = array_merge($arrPosts, $pstPublic);
  }
  return $arrPosts;
}

function updateUserProfile($id, $displayName, $phoneNumber, $avatarImage, $yearOfBirth, $nickName, $introContent, $backgroundImage)
{
  global $db;
  $stmt = $db->prepare("UPDATE users SET displayName=?, phoneNumber=?, avatarImage=?, yearOfBirth=?, nickName=?, introContent=?, backgroundImage=? WHERE id=?");
  return $stmt->execute(array($displayName, $phoneNumber, $avatarImage, $yearOfBirth, $nickName, $introContent, $backgroundImage, $id));
}

function sendFriendRequest($userId1, $userId2)
{ 
  global $db;
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $dateNow = date("Y-m-d H:i:s");
  $stmt = $db->prepare("INSERT INTO friendship SET userId1=?, userId2=?, createdAt=?");
  return $stmt->execute(array($userId1, $userId2, $dateNow));
}

function removeFriendRequest($userId1, $userId2)
{ 
  global $db;
  $stmt = $db->prepare("DELETE FROM friendship WHERE (userId1=? AND userId2=?) OR (userId1=? AND userId2=?)");
  return $stmt->execute(array($userId1, $userId2, $userId2, $userId1));
}

function getFriendShip($userId1, $userId2)
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM friendship WHERE userId1=? AND userId2=?");
  $stmt->execute(array($userId1, $userId2));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}