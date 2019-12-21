<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['postId']) && isset($_POST['role'])) {
    changePostPrivacy($_POST['postId'], $currentUser['id'], $_POST['role']);
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}
