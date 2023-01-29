<?php
include "dbcon.php";
require "loginClass.php";

if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
if ($_SESSION['role'] == 3) {
    header("location:CleanerDashboard.php");
}
$sql = "Select * from User where exists (
select * from Opdrachten where Datum=Curdate() and Opdrachten.UserId = User.UserId

)";


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
<div class="">
    <div class="text-4xl text-center  justify-between"
         style=" border-bottom: solid 1px; padding-right:10px;margin-top: 10px;  height: 60px;">
        <a href="Kamers.php">
            <div class="text-base   " style="margin-left: 10px;float: left;height: 40px;
    display: flex;
    align-items: center;"><i class="m-2 fa-solid fa-arrow-left"></i>Terug
            </div>
        </a>
        <div>
            <?php if ($_SESSION['role'] == 1) {
                echo "Super Beheerder Admin-Panel";
            }
            if ($_SESSION['role'] == 2) {
                echo "Beheerder Admin-Panel";
            } ?>
        </div>


    </div>


</div>
<div>


<div class="flex">
    <?php foreach (mysqli_query($conn, $sql) as $row) { ?>
    <div class="w-1/5 mt-5">


        <div class="w-5/5 rounded-md min-h-60 mr-2 ml-2   bg-yellow-500 items-center m-auto p-2 mb-5">
            <div class="max-w-full">
                <div class="w-5/5 max-h-full">
                    <div class="text-l ">
                        <div class="  p-2  justify-between items-center flex" style="align-items: revert;">
                            <div class="text-center m-auto flex  ">

                                <div class="w-5/5 m-auto mr-5 text-center"><b>Schoonmaak(st)er Naam:</b>
                                </div>


                                <div><?php echo $row["Naam"]; ?></div>
                                <?php $sql2 = "select User.Naam as name,User.UserId,Opdrachten.Eindtijd,Opdrachten.KamerId, Kamers.Naam as Kamer,Opdrachten.Starttijd,Opdrachten.VerwachtteEindtijd,Opdrachten.Datum from User inner join Opdrachten on User.UserId = Opdrachten.UserId inner join Kamers on Kamers.KamerId = Opdrachten.KamerId where Datum=CURDATE() and Opdrachten.UserId = User.UserId  and Opdrachten.UserId = $row[UserId] order by Opdrachten.VerwachtteEindtijd asc"; ?>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>


        <?php
        foreach (mysqli_query($conn, $sql2) as $row2) { ?>
            <div class="w-6/6 rounded-md min-h-60   bg-green-400 items-center m-auto mr-2 ml-2 p-2 mb-5">

            <div class="max-w-full">
                <div class="w-5/5 max-h-full">
                    <div class="text-l ">
                        <div class=" " style="align-items: revert;">

                            <div class="flex">
                                <div class="w-5/5 mr-5 text-l text-center">
                                    <b>Kamer: </b><?php echo $row2["Kamer"]; ?></div>
                                <div class="w-5/5 mr-5 text-l text-center"><b>Start
                                        tijd: </b><?php echo $row2['Starttijd']; ?></div>
                                <div class="w-5/5 mr-5 text-l text-center">
                                    <b>Verwachtte
                                        eindtijd: </b><?php echo $row2['VerwachtteEindtijd']; ?></div>
                                <?php if ($row2['Eindtijd'] != null){ ?>
                                <div class="w-5/5 mr-5 text-l text-center">
                                    <b>Eindtijd: </b><?php echo $row2['Eindtijd']; ?></div>
                            </div>
                                <?php } ?>


                                <?php

                                if ($row2['Eindtijd'] != null) {
                                    $start = new DateTime($row2['VerwachtteEindtijd']);
                                    $end = new DateTime($row2['Eindtijd']);

                                    // Calculate the difference between the times
                                    $difference = $end->diff($start);

                                    // Output the result


                                    if ($difference->format('%H') > 0) { ?>
                                        <div class="text-red-600 p-2"><i
                                                class="fa-solid fa-circle-exclamation pr-2"></i><?php echo $row2['name'] . " is " . $difference->format("%H") . " uur en " . $difference->format("%i") . " minuten te laat"; ?>
                                        </div><?php
                                    } else {
                                        ?>
                                        <div class="text-red-600 p-2"><i
                                                class="fa-solid fa-circle-exclamation pr-2"></i><?php echo $row2['name'] . " is " . $difference->format("%i") . " minuten te laat"; ?>
                                        </div><?php
                                    }


                                }
                                ?>



                        </div>

                    </div>
                </div>
            </div>
            </div>
    <?php
        }
        ?>

    </div>
</div>
        </div>

<?php } ?>


</div>



</body>
</html>
