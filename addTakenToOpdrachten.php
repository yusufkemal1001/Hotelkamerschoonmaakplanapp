<?php
include "dbcon.php";

if (isset($_POST['submit'])){
    $kamerId = $_GET['KamerId'];
    $startTime = $_POST['start-time'];
    $endTime = $_POST['endTime'];
    echo "$kamerId  $startTime $endTime";
    $selectUser = "select * from User where Rol != 3";
    $array = array();
    foreach (mysqli_query($conn,$selectUser) as $row){

        $array[] = $row['UserId'];
    }

    $arrayToDb = serialize($array);
    $sql = "Insert Into Opdrachten(KamerId,Datum,StartTijd,VerwachtteEindtijd,Notificatie) VALUES ('$kamerId',current_date ,'$startTime','$endTime','$arrayToDb');";



    if (mysqli_query($conn,$sql)){
        $last_id = $conn->insert_id;
        header("location:SchoonmaaksterKoppelen.php?KamerId=$kamerId&OpdrachtId=$last_id");
    }

}else{
    echo "Een fout is opgetreden.";
}



?>