<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['id'])) {
    $user = findUserById($_POST['id']);
    removeFriendRequest($currentUser['id'], $user['id']);
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}
