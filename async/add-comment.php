<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['postId']) && isset($_GET['content'])) {
    addComment($_GET['postId'], $currentUser['id'], $_GET['content']);

    $user = findUserById($currentUser['id']);
    $user['avatarImage'] = base64_encode($user['avatarImage']);
    $user['backgroundImage'] = base64_encode($user['backgroundImage']);

    echo json_encode($user);
}