<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['messageid'])) {
    deleteMessage($_POST['messageid']);
    echo json_encode(array('success' => true));
}