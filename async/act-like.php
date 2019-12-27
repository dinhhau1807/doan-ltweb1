<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['userId']) && isset($_GET['postId'])) {
    $userId = $_GET['userId'];
    $postId = $_GET['postId'];
    $like = false;
    $countLike = 0;

    if(wasLike($userId, $postId)) {
        removeLike($userId, $postId);
    } else {
        $like = true;
        addLike($userId, $postId);
    }

    $countLike = countLike($postId);

    echo json_encode(array('like' => $like, 'countLike' => $countLike));
}