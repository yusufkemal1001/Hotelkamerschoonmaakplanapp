<?php
include "dbcon.php";

$sql = "UPDATE Opdrachten
SET UserId = $_GET[UserId]
WHERE OpdrachtId = $_GET[OpdrachtId];";

$selectTaken = "Select * from Taken_Van_Kamer where KamerId = $_GET[KamerId]";
foreach (mysqli_query($conn,$selectTaken) as $row){
    $sql1 = "Insert into Taken_Van_Opdrachten(TaakId,OpdrachtId,UserId,Afgerond) values ($row[TaakId],$_GET[OpdrachtId],$_GET[UserId],0)";
    mysqli_query($conn,$sql1);
}


if (mysqli_query($conn,$sql)){
    header("Location:AdminDashboard.php?KamerGekoppeld");
}else{
    echo "fuck";
}



?>