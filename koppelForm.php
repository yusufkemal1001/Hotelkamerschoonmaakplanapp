<?php
include "dbcon.php";
$kamerId = $_GET['KamerId'];
$sql = "select * from Taken_Van_Kamer where KamerId=$kamerId ";
$result = mysqli_query($conn, $sql);

$kamerNaam = "select * from Kamers where KamerId = $kamerId";
$resultKamer = mysqli_query($conn, $kamerNaam);
$kamer = mysqli_fetch_assoc($resultKamer);


$countTime = "SELECT SUM(Duur)
FROM Taken_Van_Kamer where KamerId=$_GET[KamerId];";


$Count = mysqli_query($conn, $countTime);
$resultCount = mysqli_fetch_assoc($Count);
$sum = $resultCount['SUM(Duur)'];
$newsum = $sum - ($sum % 5);
$newsum = $newsum - 60;
$hours = floor($sum / 60);
$minutes = $sum % 60;
$ms = $newsum * 60 * 1000;
$newMinutes = $minutes - ($minutes % 5);

if (mysqli_num_rows($result)<1){
    header("location:AdminDashboard.php");
}
if (mysqli_num_rows($resultKamer)<1){
    header("location:AdminDashboard.php");
}
if (mysqli_num_rows($Count)<1){
    header("location:AdminDashboard.php");
}
?>
<div class="m-5" style="margin-left: 40%;">

    <div class="text-xl  "><b>Kamer naam :</b> <?php echo $kamer['Naam']; ?></div>
    <br>

    <div class="text-xl  "><b>Taken:</b>
        <div>
            <?php
            foreach ($result as $taak) {

                $sql1 = "Select * from Taken where TaakId = $taak[TaakId]";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1)<1){
                    header("location:AdminDashboard.php");
                }
                foreach ($result1 as $taken) { ?>
                    <div>
                    <?php echo $taken['Taak']; ?><br>
                    </div><?php
                }


            }

            ?>
        </div>
    </div>
    <br>

    <form action="addTakenToOpdrachten.php?KamerId=<?php echo $_GET['KamerId']; ?>" method="post" class="text-xl">
        <div class="">
            <div class="">
                <b>Start Time</b><?php
                if (isset($_GET['OpdrachtId'])) {
                    $selectStartTime = "select TIME_FORMAT(Starttijd,'%H:%i') as sT, TIME_FORMAT(VerwachtteEindtijd,'%H:%i') as eT from Opdrachten where OpdrachtId = $_GET[OpdrachtId]";
                    $resultStart = mysqli_query($conn, $selectStartTime);
                    $rowStart = mysqli_fetch_assoc($resultStart);
                    if (mysqli_num_rows($resultStart)<1){
                        header("location:AdminDashboard.php");
                    }
                }
                ?>
                <input type="time" id="start-time" name="start-time" value="<?php if (isset($_GET['OpdrachtId'])) {
                echo $rowStart['sT'];

                ?>" readonly <?php } ?> class="ml-2" onchange="setEndTime()">
                <div><br>
                    <b>End Time</b>
                    <input type="time" id="end-time" value="<?php if (isset($_GET['OpdrachtId'])) {
                        echo $rowStart['eT'];
                    } ?>" name="endTime" readonly>
                </div><?php
                ?>

            </div>
            <br>
            <div class="text-center text-xs">Totale duur van kamer is <?php echo $hours ?> uur<?php if ($minutes > 0) {
                    echo " en " . $minutes . " minuten";
                } ?> </div>
            <br>


        </div>
        <button class="flex m-auto p-2 rounded-md" <?php if (isset($_GET['OpdrachtId'])) { ?> disabled <?php } ?>
                style="background-color: #78A300; color: white" type="submit"
                name="submit">Beschikbare schoonmaak(st)ers zien
        </button>
    </form>
</div>
<script>
    function setEndTime() {
        var startTime = document.getElementById("start-time").value;
        var startTimeObject = new Date("1970-01-01T" + startTime + "Z");
        var endTimeObject = new Date(startTimeObject.getTime() + <?php echo $ms; ?>); // Add 1 hour in milliseconds
        var endTime = endTimeObject.toTimeString().split(" ")[0];
        document.getElementById("end-time").value = endTime;
    }
</script>









