<?php
include "dbcon.php";
require_once "loginClass.php";

$select = new Select();


if (isset($_SESSION["id"])) {
    $userid = $select->selectUserById($_SESSION["id"]);
} else {
    header("location: index.php");
}


$sql = "select Opdrachten.Starttijd,Opdrachten.OpdrachtId,Opdrachten.Datum, Opdrachten.VerwachtteEindtijd,Kamers.KamerId, Kamers.Naam,Opdrachten.KamerId from Opdrachten inner join Kamers on Kamers.KamerId = Opdrachten.KamerId where UserId = $_SESSION[id] and CURTIME() < TIME(VerwachtteEindtijd) and Eindtijd is NULL and Datum = CURDATE() ";
$result = $conn->query($sql);

if (isset($_GET['KamerId'])){
    $getRoom = "select * from Kamers where KamerId = $_GET[KamerId]";
    $resultRoom = mysqli_query($conn,$getRoom);
    $rowRoom = mysqli_fetch_assoc($resultRoom);
}


if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $startTime = $row['Starttijd'];


        ?><br><?php
        $date = new DateTime("now", new DateTimeZone('Europe/Amsterdam'));
        $currentTime = $date->format('H:i');
        $endTime = $row['VerwachtteEindtijd'];
        $restStart = substr($startTime, 0, -3);
        $restEnd = substr($endTime, 0, -3);
        //$currentTime = date('H:i' , $Time);

        if ($currentTime >= $startTime) {


            ?>
            <?php  if (isset($_GET['OpdrachtDone'])){?>
                <div class="pr-5 pb-5 pl-5 text-green-600"><?php echo $row['Naam']; ?> is schoongemaakt!
                </div>
            <?php }  ?>
             <div class="pr-5 pb-5 pl-5 text-yellow-600"><i class="fa-solid mr-2 fa-circle-exclamation"></i>U mag beginnen met '<?php echo $row['Naam']; ?>' schoonmaken!
            </div>
            <a href="takenAfvinken.php?KamerId=<?php echo $row['KamerId']; ?>&Opdracht=<?php echo $row['OpdrachtId'] ?>">
                <div class="w-5/6 rounded-md min-h-60   bg-green-400 items-center m-auto p-5 mb-5">

                <div class="max-w-full">
                    <div class="w-5/5 max-h-full">
                        <div class="text-xl ">
                            <div class=" " style="align-items: revert;">
                                <input type="hidden" value="">
                                <div class=" grid grid-cols-3">
                                    <div class="w-5/5 mr-5 text-xl text-center">
                                        <b>Kamer: </b><?php echo $row["Naam"]; ?></div>
                                    <div class="w-5/5 mr-5 text-xl text-center"><b>Start
                                            tijd: </b><?php echo $restStart; ?></div>
                                    <div class="w-5/5 mr-5 text-xl text-center"><b>Eind
                                            tijd: </b><?php echo $restEnd; ?></div>
                                </div>
                                <div class="">
                                    <?php
                                    $start = new DateTime($startTime);
                                    $end = new DateTime($currentTime);

                                    // Calculate the difference between the times
                                    $difference = $end->diff($start);

                                    // Output the result

                                    if ($difference->format('%i') > 15 || $difference->format('%h') > 0) {
                                        if ($difference->format('%H') > 0) { ?>
                                            <div class="text-red-600 p-2"><i
                                                    class="fa-solid fa-circle-exclamation pr-2"></i><?php echo "U bent " . $difference->format("%H") . " uur en " . $difference->format("%i") . " minuten te laat"; ?>
                                            </div><?php
                                        } else {
                                            ?>
                                            <div class="text-red-600 p-2"><i
                                                    class="fa-solid fa-circle-exclamation pr-2"></i><?php echo "U bent " . $difference->format("%i") . " minuten te laat"; ?>
                                            </div><?php
                                        }

                                    }
                                    ?>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                </div>
            </a>
        <?php } else {
            ?>
            <div class="w-5/6 rounded-md min-h-60   bg-gray-500 items-center m-auto p-5  mb-5" ">

            <div class="max-w-full">
                <div class="w-5/5 max-h-full">
                    <div class="text-xl ">
                        <div class=" " style="align-items: revert;">
                            <input type="hidden" value="">
                            <div class="text-white grid grid-cols-3">
                                <div class="w-5/5 mr-5 text-xl text-center"><b>Kamer: </b><?php echo $row["Naam"]; ?>
                                </div>
                                <div class="w-5/5 mr-5 text-xl text-center"><b>Start tijd: </b><?php echo $restStart; ?>
                                </div>
                                <div class="w-5/5 mr-5 text-xl text-center"><b>Eind tijd: </b><?php echo $restEnd; ?>
                                </div>
                            </div>
                            <div class="text-white">
                                <?php
                                $start = new DateTime($startTime);
                                $end = new DateTime($currentTime);

                                // Calculate the difference between the times
                                $difference = $start->diff($end);

                                // Output the result
                                echo 'Nog ' . $difference->format('%H:%I') . ' om deze kamer schoon te maken';
                                //                                    $difference = $restStart->diff($currentTime);
                                //                                    echo $difference->format('%H:%i');

                                ?>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            </div>
        <?php }
    }
} else {
    if (isset($_GET['OpdrachtDone'])){?>
            <div class="pr-5 pb-5 pl-5 text-green-600"><?php echo $rowRoom['Naam']; ?> is schoongemaakt!
            </div>
        <?php }?>
    <i class="fa-solid fa-circle-exclamation"></i> Geen Opdrachten!
<?php
}


?>