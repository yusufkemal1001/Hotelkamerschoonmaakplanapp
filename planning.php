<?php
include "dbcon.php";

// Connect to the database


// Get the value from the AJAX request
$value = $_POST['value'];

// Run the appropriate SQL query

$sql = "select User.Naam as name,User.UserId,Opdrachten.Eindtijd,Opdrachten.KamerId, Kamers.Naam as Kamer,Opdrachten.Starttijd,Opdrachten.VerwachtteEindtijd,Opdrachten.Datum from User inner join Opdrachten on User.UserId = Opdrachten.UserId inner join Kamers on Kamers.KamerId = Opdrachten.KamerId where Datum=CURDATE() and Opdrachten.UserId = User.UserId  and Opdrachten.UserId = $value order by Opdrachten.VerwachtteEindtijd asc";

$result = $conn->query($sql);

// Fetch the data from the query
while ($row = $result->fetch_assoc()) {
    echo "<div data-value='$value'  class='m-auto' id='$row[VerwachtteEindtijd]'>";?>
    <div class="w-4/5 mt-5 rounded-md min-h-60 mr-auto ml-auto   bg-yellow-500 items-center   p-2 mb-5">

        <div class="max-w-full">
            <div class="w-5/5 max-h-full">
                <div class="text-l ">
                    <div class=" " style="align-items: revert;">

                        <div class="grid grid-cols-5">
                            <div class="w-5/5 mr-5 text-l text-center">
                                <b>Schoonmaak(st)er: </b><?php echo $row["name"]; ?></div>
                            <div class="w-5/5 mr-5 text-l text-center">
                                <b>Kamer: </b><?php echo $row["Kamer"]; ?></div>
                            <div class="w-5/5 mr-5 text-l text-center"><b>Start
                                    tijd: </b><?php echo $row['Starttijd']; ?></div>
                            <div class="w-5/5 mr-5 text-l text-center">
                                <b>Verwachtte
                                    eindtijd: </b><?php echo $row['VerwachtteEindtijd']; ?></div>
                            <?php if ($row['Eindtijd'] != null){ ?>
                            <div class="w-5/5 mr-5 text-l text-center">
                                <b>Eindtijd: </b><?php echo $row['Eindtijd']; ?></div>
                        </div>
                        <?php } ?>


                        <?php

                        if ($row['Eindtijd'] != null) {
                            $start = new DateTime($row['VerwachtteEindtijd']);
                            $end = new DateTime($row['Eindtijd']);

                            // Calculate the difference between the times
                            $difference = $end->diff($start);

                            // Output the result


                            if ($difference->format('%H') > 0) { ?>
                                <div class="text-red-600 p-2"><i
                                        class="fa-solid fa-circle-exclamation pr-2"></i><?php echo $row['name'] . " is " . $difference->format("%H") . " uur en " . $difference->format("%i") . " minuten te laat"; ?>
                                </div><?php
                            } else {
                                ?>
                                <div class="text-red-600 p-2"><i
                                        class="fa-solid fa-circle-exclamation pr-2"></i><?php echo $row['name'] . " is " . $difference->format("%i") . " minuten te laat"; ?>
                                </div><?php
                            }


                        }
                        ?>



                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php echo "</div>";
}


?>


