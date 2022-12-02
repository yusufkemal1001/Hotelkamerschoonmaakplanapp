<?php
require 'loginClass.php';
$_SESSION = [];
session_unset();
session_destroy();
header('location: index.php');
if (isset($_SESSION['user_id'])){
    header("Location:dashboard.php");
}