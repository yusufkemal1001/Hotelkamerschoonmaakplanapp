<?php
include "dbcon.php";
require_once "loginClass.php";

if (!isset($_SESSION['id'])){
    header("location:index.php");
}

if (isset($_POST['kamerName'])){
    $kamerName = $_POST['kamerName'];
    $kamerName = mysqli_escape_string($conn,$kamerName);

    $kamerName = strval($kamerName);
    $kamerSql = "UPDATE Kamers SET Naam= '$kamerName' where KamerId= $_GET[KamerId]";
    mysqli_query($conn,$kamerSql);


}


if (isset($_POST['taak'])){


    foreach ($_POST['taak'] as $taak) {




        if ($taak['duur'] < 1 || is_numeric($taak['duur'])==false){

            header("location:Kamers.php?KamerId=$_GET[KamerId]&valueBiggerThanOne");
            break;


        }else{
            $taakNaam = $taak['naam'];
            $taakNaam = strval($taakNaam);
            $sql = "UPDATE Taken SET Taak='$taakNaam' where TaakId=$taak[taakId] and Vast=0;";
            $sql .= "UPDATE Taken_Van_Kamer SET Duur = $taak[duur] where TaakId=$taak[taakId] and KamerId=$_GET[KamerId]";
//

//        mysqli_query($conn,$sql1);
//        mysqli_query($conn,$sql);


            if (mysqli_multi_query($conn, $sql)) {
                do {
                    /* store first result set */
                    if ($result = mysqli_store_result($conn)) {
                        while ($row = mysqli_fetch_array($result))

                            /* print your results */
                        {
                            echo $row['column1'];
                            echo $row['column2'];
                        }
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($conn));
                if ($_POST['action'] == 'opslaan'){
                    header("location:Kamers.php?KamerId=".$_GET['KamerId']."&Saved");
                    echo $taak['naam'];
                }else{
                    header("location:SchoonmaaksterKoppelen.php?KamerId=".$_GET['KamerId']);
                }

            }
        }

    }


}
if (isset($_POST['nieuweTaak'])){
    foreach ($_POST['nieuweTaak'] as $nieuweTaak) {
        if ($nieuweTaak['duur'] < 1 || is_numeric($nieuweTaak['duur'])==false){


            header("location:Kamers.php?KamerId=$_GET[KamerId]&valueBiggerThanOne");
            break;

        }else{
            $sql = "insert into Taken(Taak,Vast) VALUES ('$nieuweTaak[naam]','0')";

            if (mysqli_query($conn,$sql)){
                $last_id = $conn->insert_id;
                echo $last_id;
                $sql1 = "insert into  Taken_Van_Kamer(TaakId,KamerId,Duur) values ($last_id, $_GET[KamerId],$nieuweTaak[duur] )" ;

                if (mysqli_query($conn,$sql1)){
                    if ($_POST['action'] == 'opslaan'){
                        header("location:Kamers.php?KamerId=".$_GET['KamerId']."&Saved");
                        echo $taak['naam'];
                    }else{
                        header("location:SchoonmaaksterKoppelen.php?KamerId=".$_GET['KamerId']);
                    }

                }

            }
        }



    }

}







?>