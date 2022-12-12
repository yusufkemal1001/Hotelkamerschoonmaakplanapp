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
$newMinutes = $minutes - ($minutes % 15)

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
        <button class="flex justify-center mb-5 m-auto" ><div class="text-center " style="height: 50px; width: 40%;border-radius: 10px;color: #000; display: flex;justify-content: center;align-items: center;"><i class="fa-regular fa-floppy-disk pr-2"></i>Opslaan</div></button>

    </div>
    </form>
</div>

