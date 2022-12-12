<?php
include "dbcon.php";
$taakId = $_GET['TaakId'];
$kamerId= $_GET['KamerId'];
$sql = "Delete from Taken where TaakId =$taakId; ";


if (mysqli_query($conn,$sql)){

    header("location: Kamers.php?KamerId=$kamerId&taakDeleted");

}else{
    echo 'Er is een fout opgetreden';
}

?>