<?php
include "dbcon.php";
$select = new Select();
if (isset($_GET["KamerId"])){
    $kamerId = $_GET['KamerId'];
    $stmt =  "Select Naam FROM Kamers WHERE KamerId = $kamerId ;";


    $result = mysqli_query($conn,$stmt);

    $row = mysqli_fetch_assoc($result);
}
$countTime= "SELECT SUM(Duur)
FROM Taken_Van_Kamer where KamerId=$_GET[KamerId];";


$Count = mysqli_query($conn,$countTime);
$resultCount = mysqli_fetch_assoc($Count);
$sum = $resultCount['SUM(Duur)'];

$hours = floor($sum / 60);
$minutes = $sum % 60;
$newMinutes = $minutes - ($minutes % 5);

$seeRoom = "select * from Opdrachten where KamerId=$_GET[KamerId] and Datum = CURDATE() and UserId is not null ";
$resultRoom = mysqli_query($conn,$seeRoom);
if (mysqli_num_rows($resultRoom) > 0) { ?>
    <div class=" text-md m-auto mt-5 rounded-md text-center"
         style="color: goldenrod; display: flex; justify-content: center; align-items: center;">
        <i class="fa-solid fa-circle-exclamation m-2"></i>Deze kamer is al gekoppeld!
    </div>
<?php }

?>

<div class="container">

    <form action="opslaan.php?KamerId=<?php echo $_GET['KamerId']; ?>" method="post">
    <div class=" flex items-center m-5">
        <a onclick="return confirm('Wilt u deze kamer verwijderen?')" href="deleteKamer.php?KamerId=<?php echo $_GET['KamerId'];?>" class="text-md"><i class="fa-regular fa-trash-can" style="display: flex; align-items: center; justify-content: center;"></i>Kamer verwijderen</a>
        <div class="m-auto text-3xl">
            Kamer:
        <input type="text" class=" text-3xl p-2 rounded-md  " style=" border: 1px solid;margin-right: 130px; " value="<?php echo $row['Naam'];?>" name="kamerName" required /><br>
        </div>
    </div>

    <div class="taken m-auto">
        <?php include "showTaken.php";?>
        <div class="text-center m-5">
            Totale duur is <?php echo $hours;  ?> uur <?php if ($newMinutes!=0){ echo "en ".$newMinutes." minuten";}?>
        </div>
        <div class="flex justify-evenly mb-10 m-auto w-3/5">
            <button name="action" class="bg-sky-800" value="opslaan" style="  border:1px solid; border-radius: 10px; color: black; padding: 10px; " ><div class="text-center " style="height: 40px; width: 250px; display: flex;justify-content: center;align-items: center;color:white; "><i class="fa-regular fa-floppy-disk pr-2"></i>Opslaan</div></button>
            <?php

                $sql = "select * from Opdrachten where KamerId = $_GET[KamerId] and Datum = CURDATE() and UserId is not NULL";
                $result1 = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result1) == 0) { ?>
                    <button name="action" value="schoonmaaksterKoppelen"  style="background-color: lightgreen; border:1px solid; border-radius: 10px; color: black; padding: 10px; " ><div class="text-center " style="height: 40px; width: 250px; display: flex;justify-content: center; align-items: center;">Schoonmaak(st)er Koppelen <i class="m-2 fa-solid fa-arrow-right"></i></div></button>
                <?php }

            ?>

        </div>
    </div>
    </form>
</div>

