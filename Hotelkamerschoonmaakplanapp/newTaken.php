<?php
include "dbcon.php";



foreach ($_POST['nieuweTaak'] as $nieuweTaak) {


    $sql = "insert into Taken(Taak,Vast) VALUES ('$nieuweTaak[naam]','0')";

    if (mysqli_query($conn,$sql)){
        $last_id = $conn->insert_id;
        echo $last_id;
        $sql1 = "insert into  Taken_Van_Kamer(TaakId,KamerId,Duur) values ($last_id, $_GET[KamerId],$nieuweTaak[duur] )" ;

        if (mysqli_query($conn,$sql1)){
            header("location:Kamers.php?KamerId=".$_GET['KamerId']);
        }

    }



//


//    if (mysqli_multi_query($conn, $sql)) {
//        do {
//            /* store first result set */
//            if ($result = mysqli_store_result($conn)) {
//                while ($row = mysqli_fetch_array($result))
//
//                    /* print your results */
//                {
//                    echo $row['column1'];
//                    echo $row['column2'];
//                }
//                mysqli_free_result($result);
//            }
//        } while (mysqli_next_result($conn));
//
//        header("location:Kamers.php?KamerId=".$_GET['KamerId']);
//    }

//    if (mysqli_query($conn,$sql1)){
//        header("location:Kamers.php?KamerId=".$_GET['KamerId']);
//
//
//    }else{
//        echo 'Er is een fout opgetreden';
//    }



}



?>