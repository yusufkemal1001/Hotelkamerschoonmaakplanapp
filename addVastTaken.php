<?php
include "dbcon.php";



$sql1 = "select * from Taken where Vast=1";
$result = $conn->query($sql1);

while ($row = $result->fetch_assoc()){
    $sql2 = "insert into Taken_Van_Kamer(TaakId,KamerId,Duur) values('$row[TaakId]','$_GET[KamerId]',30)";
    mysqli_query($conn,$sql2);
}

if (mysqli_query($conn,$sql1)){

    header("location: Kamers.php?KamerId=$_GET[KamerId]&nieuweKamer");


}else{
    echo 'Er is een fout opgetreden';
}