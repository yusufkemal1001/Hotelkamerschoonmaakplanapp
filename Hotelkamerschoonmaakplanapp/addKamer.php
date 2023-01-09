<?php
include 'dbcon.php';

$sql = "insert into Kamers(Naam)values('Nieuwe Kamer');";


if (mysqli_query($conn,$sql)){
    $last_id = $conn->insert_id;
    header("location: addVastTaken.php?KamerId=$last_id");

}else{
    echo 'Er is een fout opgetreden';
}
?>

