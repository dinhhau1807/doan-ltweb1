<?php 
require_once 'init.php';
if (!$currentUser) {
  header('Location: index.php');
  exit();
}

header("Content-Type:image/jpg");

if(isset($_GET['userId'])) {
  $image = getAvatarImage($_GET['userId']);
  // $source = "data:image/jpeg;base64,".base64_encode($image['avatarImage']);
  echo $image['avatarImage'];
} else if(isset($_GET['postId'])) {
  $image = getPostImage($_GET['postId']);
  echo $image['image'];
}