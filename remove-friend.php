<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['id'])) {
    $user = findUserById($_POST['id']);
} else {
    header('Location: index.php');
}

removeFriendRequest($currentUser['id'], $user['id']);
removeFollow($currentUser['id'], $user['id']);
removeFollow($user['id'], $currentUser['id']);

header("Location: profile.php?id={$user['id']}");