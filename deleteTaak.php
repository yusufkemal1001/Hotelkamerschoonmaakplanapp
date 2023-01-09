<?php
include "dbcon.php";
$taakId = $_GET['TaakId'];
$kamerId= $_GET['KamerId'];
$sql = "Delete from Taken where TaakId =$taakId; ";
$sql1 = "Delete from Taken_Van_Kamer where TaakId =$taakId; ";

if (mysqli_query($conn,$sql)){
    if (mysqli_query($conn,$sql1)){
        header("location: Kamers.php?KamerId=$kamerId&taakDeleted");
    }else{
        echo 'Er is een fout opgetreden';
    }



}else{
    echo 'Er is een fout opgetreden';
}

?>