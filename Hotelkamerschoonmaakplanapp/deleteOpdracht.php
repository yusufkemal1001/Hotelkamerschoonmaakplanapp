<?php
include "dbcon.php";

$kamerId = $_GET['KamerId'];

$sql = "delete from Opdrachten where KamerId=$kamerId and Datum = CURDATE();";
if (mysqli_query($conn,$sql)){
    header("Location:Kamers.php?KamerId=$kamerId");
}

?>