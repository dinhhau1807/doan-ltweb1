<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['userId'])) {
    $user = findUserById($_GET['userId']);

    echo json_encode(array('name' => $user['displayName'], 'image' => base64_encode($user['avatarImage'])));
}