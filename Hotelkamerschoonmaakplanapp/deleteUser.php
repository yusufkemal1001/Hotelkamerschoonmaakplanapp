<?php
include "dbcon.php";
$UserId = $_GET['UserId'];

$sql = "Delete from User where UserId =$UserId; ";


if (mysqli_query($conn,$sql)){

    header("location: accounts.php?userDeleted");

}else{
    echo 'Er is een fout opgetreden';
}

?>