<?php
session_start();

require 'core/pdo.php';
require('core/mail.php');
require 'PHP/octaValidate-PHP-main/src/Validate.php';

$db = new DatabaseClass();
$currentTime = time();
if (isset($_SESSION['auth']) && isset($_SESSION["user_id"]) && $currentTime < $_SESSION['expire']) {
     include_once('autheader.php');
} else {
     include_once('header.php');
     unset($_SESSION['user_id']);
     unset($_SESSION['expire']);
     unset($_SESSION['auth']);
}
?>