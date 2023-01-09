<?php
include "dbcon.php";

$kamerId= $_GET['KamerId'];
$sql = "Delete from Kamers where KamerId =$kamerId; ";


if (mysqli_query($conn,$sql)){

    header("location: Kamers.php?KamerDeleted");

}else{
    echo 'Er is een fout opgetreden';
}

?>