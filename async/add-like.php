<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
else{
    if (isset($_POST['type']) && $_POST['type'] == "like") {	
        	
        likePost($currentUser['id'], $_POST['postLike']);
        $numLike = countLiked($_POST['postLike']);
        $result = ['status' => 200, 'like'=> $numLike];
        echo json_encode($result);
    }
    else if (isset($_POST['type']) && $_POST['type'] == "unlike") {	
        	
        unlikePost($currentUser['id'], $_POST['postLike']);
        $numLike = countLiked($_POST['postLike']);
        $result = ['status' => 200, 'like'=> $numLike];
        echo json_encode($result);
    }
    else {
        echo "Are you kidding me ? ";
    }
}