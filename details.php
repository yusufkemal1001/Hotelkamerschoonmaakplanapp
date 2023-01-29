<?php
include "dbcon.php";
require_once "loginClass.php";
if ($_SESSION['role']==3){
    header("location:CleanerDashboard.php");
}

$sql = "select Taken.Taak, Taken_Van_Kamer.`Duur`,Taken_Van_Opdrachten.NieuwDuur,Taken_Van_Opdrachten.TaakOpdrachtId, Taken_Van_Opdrachten.Afgerond from Taken_Van_Opdrachten Inner join Taken on Taken.TaakId=Taken_Van_Opdrachten.TaakId inner join Taken_Van_Kamer on Taken_Van_Kamer.TaakId = Taken_Van_Opdrachten.TaakId where Taken_Van_Opdrachten.OpdrachtId = $_GET[Opdracht] and Taken_Van_Kamer.KamerId = $_GET[KamerId]";
$getKamer = "select * from Kamers where KamerId = $_GET[KamerId]";
$resultKamer = mysqli_query($conn, $getKamer);
$rowKamer = mysqli_fetch_assoc($resultKamer);

$countTime = "SELECT SUM(Duur)
FROM Taken_Van_Kamer where KamerId=$_GET[KamerId];";

$selectDatum = "select OpdrachtId,UserId,KamerId,Starttijd,DATE_FORMAT(Datum,'%d-%m-%Y') as Datum,Eindtijd,VerwachtteEindtijd,Opmerking from Opdrachten  where OpdrachtId = $_GET[Opdracht]";
$resultDatum = mysqli_query($conn, $selectDatum);
$rowDatum = mysqli_fetch_assoc($resultDatum);

$Count = mysqli_query($conn, $countTime);
$resultCount = mysqli_fetch_assoc($Count);
$sum = $resultCount['SUM(Duur)'];

$user = "select * from User where UserId = $rowDatum[UserId]";
$resultUser = mysqli_query($conn,$user);
$rowUser = mysqli_fetch_assoc($resultUser);

$hours = floor($sum / 60);
$minutes = $sum % 60;
$newMinutes = $minutes - ($minutes % 5);

$difference = "SELECT SUBTIME(Eindtijd,StartTijd) from Opdrachten where OpdrachtId = $_GET[Opdracht];";
$differencetime = mysqli_query($conn, $difference);
$rowTime = mysqli_fetch_assoc($differencetime);
$differenceTimee = $rowTime['SUBTIME(Eindtijd,StartTijd)'];

$differenceVerwachtteEindtijd = "SELECT SUBTIME(Eindtijd,VerwachtteEindtijd) from Opdrachten where OpdrachtId = $_GET[Opdracht]";
$resultVerwachtteEindtijd = mysqli_query($conn,$differenceVerwachtteEindtijd);
$rowVerwachtteEindtijd = mysqli_fetch_assoc($resultVerwachtteEindtijd);
$sumTime = $rowVerwachtteEindtijd['SUBTIME(Eindtijd,VerwachtteEindtijd)'];

$timeParts = explode(':', $sumTime);
$hourTime = $timeParts[0];
$minutesTime = $timeParts[1];

$datetime1 = new DateTime($rowDatum['VerwachtteEindtijd']);
$datetime2 = new DateTime($rowDatum['Eindtijd']);
$interval = $datetime2->diff($datetime1);
$hourTime = $interval->format('%h');
$minutesTime = $interval->format('%i');


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dist/output.css">
    <script src="https://kit.fontawesome.com/a5e31d35c1.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="w-4/4">
    <div class=" text-center m-5 ">
        <a href="AdminDashboard.php">
            <div class="text-base   " style="margin-left: 10px;float: left;height: 40px;
    display: flex;
    align-items: center;"><i class="m-2 fa-solid fa-arrow-left"></i>Terug
            </div>
        </a>
        <div class="text-4xl text-center " style="margin-right: 80px;">
            <?php echo $rowKamer['Naam']; ?>
        </div>
        <div class="w-4/5 mt-5 flex  justify-between m-auto  " style="color: #122932;">
            <div>
                <b>Schoonmaak(st)er: </b><?php echo $rowUser['Naam']; ?>
            </div>
            <div>
                <b>Datum:</b> <?php echo $rowDatum['Datum']; ?>
            </div>
            <div>
                <b>Geschatte duur: </b><?php echo $hours; ?> uur <?php if ($newMinutes != 0) {
                    echo "en " . $newMinutes . " minuten";
                } ?>
            </div>

        </div>
        <div class="w-4/5 mt-5 flex  justify-between m-auto  " style="color: #122932;">

            <div>
                <b>Starttijd: </b><?php echo $rowDatum['Starttijd']; ?>
            </div>
            <div>
                <b>Verwachtte Eindtijd: </b><?php echo $rowDatum['VerwachtteEindtijd']; ?>
            </div>
            <div>
                <b>Eindtijd: </b><?php echo $rowDatum['Eindtijd']; ?>
            </div>
            <div>
                <b>Activiteitsduur: </b><?php echo $differenceTimee; ?>
            </div>
        </div>

    </div>
    <?php if ($rowDatum['Eindtijd'] > $rowDatum['VerwachtteEindtijd']){?>
    <div class="text-red-500 text-center">
        <?php echo  $rowKamer['Naam'];?> is
        <?php if ($hourTime > 0 && $minutesTime>0){
            echo $hourTime." uur en ".$minutesTime." minuten te laat schoongemaakt!";
        }elseif ($hourTime > 0 && $minutesTime <=0) {
            echo $hourTime." uur te laat schoongemaakt!";
        }else{
            echo $minutesTime." minuten te laat schoongemaakt!";
        }?>
    </div>
    <?php }?>
    <div class="text-center  mt-5 mb-3">
        <i class="text-xl">Melding:</i><br>

        <textarea name="opmerking" id="" cols="30" rows="5" class="w-3/5 p-2 rounded-md" style="border: 1px solid;" disabled><?php echo $rowDatum['Opmerking']?></textarea>


    </div>
    <div class="text-xl text-center mt-5">
        <i>Taken</i>
    </div>
    <div class="w-3/5 m-auto text-center">
        <div class=" text-center grid grid-cols-2">
            <?php foreach (mysqli_query($conn, $sql) as $row) { ?>
                <div class="p-6 m-5 rounded-md" style="border: 1px solid; background-color: #2C514C; color: white;">
                    <div class="text-center">
                        <b><?php echo $row['Taak']; ?></b><br>
                    </div>
                    <?php
                    if ($row['NieuwDuur'] != NULL) {
                        ?>
                        <div class="flex  ">
                            <div class="m-auto">
                                <i>Duur(min):</i> <?php echo $row['Duur']; ?>
                            </div>
                            <div class="m-auto">

                                <i>Nieuwe duur(min): </i><?php echo $row['NieuwDuur']; ?>

                            </div>
                        </div>
                    <?php } else {
                        ?>
                        <div class="flex  ">
                            <div class="m-auto">
                                <i>Duur(min):</i> <?php echo $row['Duur']; ?>
                            </div>
                        </div>
                    <?php }

                    ?>
                </div>


            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>