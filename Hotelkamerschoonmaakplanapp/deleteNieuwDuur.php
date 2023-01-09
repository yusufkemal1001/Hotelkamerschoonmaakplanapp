<?php
include "dbcon.php";
$id = $_GET['id'];
$sql = "UPDATE Taken_Van_Opdrachten SET NieuwDuur = NULL where TaakOpdrachtId = '$id' ";

if (mysqli_query($conn,$sql)){
    header("location:takenAfvinken.php?KamerId=$_GET[KamerId]&Opdracht=$_GET[Opdracht]");
}


?>