<?php
session_start();
require('core/pdo.php');

$db = new DatabaseClass();
$currentTime = time();
if (isset($_SESSION['auth']) && isset($_SESSION["user_id"]) && $currentTime < $_SESSION['expire']) {
     include('autheader.php');
} else {
     include('header.php');
     unset($_SESSION['user_id']);
     unset($_SESSION['expire']);
     unset($_SESSION['auth']);
}
