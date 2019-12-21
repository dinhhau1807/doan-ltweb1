<?php
require_once '../init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['touserid']) && isset($_GET['content'])) {
    sendMessage($currentUser['id'], $_GET['touserid'], $_GET['content']);
    echo json_encode(array('success' => true));
}