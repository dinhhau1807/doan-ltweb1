<?php
// Load core functions
require_once 'functions.php';
require_once 'config.php';

ob_start();
// Report errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Detect page
$page = detectPage();

// Connect database
$db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASSWORD);

// Authentication
$currentUser = null;
if (isset($_SESSION['userId'])) {
  $currentUser = findUserById($_SESSION['userId']);
}
