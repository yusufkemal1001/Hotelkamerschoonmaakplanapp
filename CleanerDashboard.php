<?php
require "loginClass.php";
if (isset($_SESSION['Login'])){
    header("location:CleanerDashboard.php");
}
$select = new Select();
if (isset($_SESSION["id"])){
    $user = $select->selectUserById($_SESSION["id"]);
}else{
    header("location: index.php");
}
//if ()
?>Hey cleaner.
<a href="logout.php">logout