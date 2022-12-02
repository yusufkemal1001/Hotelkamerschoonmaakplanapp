<?php
include 'dbcon.php';





$sql = "insert into Kamers(Naam)values('Nieuwe Kamer');";


if (mysqli_query($conn,$sql)){

    header("location: Kamers.php?nieuweKamer");

}else{
    echo 'Er is een fout opgetreden';
}
?>

