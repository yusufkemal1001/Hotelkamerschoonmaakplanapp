<?php
include "dbcon.php";

if (isset($_POST['submit'])){
    $kamerId = $_GET['KamerId'];
    $startTime = $_POST['start-time'];
    $endTime = $_POST['endTime'];
    echo "$kamerId  $startTime $endTime";
    $sql = "Insert Into Opdrachten(KamerId,Datum,StartTijd,VerwachtteEindtijd) VALUES ('$kamerId',current_date ,'$startTime','$endTime');";


    if (mysqli_query($conn,$sql)){
        $last_id = $conn->insert_id;
        header("location:SchoonmaaksterKoppelen.php?KamerId=$kamerId&OpdrachtId=$last_id");
    }

}else{
    echo "fuck";
}



?>