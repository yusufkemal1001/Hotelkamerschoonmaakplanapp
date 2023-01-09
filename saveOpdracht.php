<?php
include "dbcon.php";
//require_once "startTaakSession.php";

session_start();

$id = $_GET['Opdracht'];
if (isset($_POST['submit'])){

    $opmerking = $_POST['textInput'];
    $sql = "UPDATE Opdrachten SET Opmerking = '$opmerking', Eindtijd = current_time() where OpdrachtId = '$id' ";


    if (mysqli_query($conn,$sql)){



        header("location: CleanerDashboard.php?OpdrachtDone&KamerId=$_GET[KamerId]");


// Set the session cookie expiration time to a time in the past

// Destroy the session




    }

}else{
    echo "Post not set";
}




?>