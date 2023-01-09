<?php
require_once "loginClass.php";
include "dbcon.php";


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


    <?php
    if (isset($_GET['KamerId'])) {
        $sql = "select * from Opdrachten where KamerId = $_GET[KamerId] and Datum = CURDATE() and UserId is not NULL";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { ?>
            <div class="text-4xl text-center  justify-between"
                 style=" border-bottom: solid 1px; padding-right:10px;margin-top: 10px;  height: 60px;">
                <a href="AdminDashboard.php">
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
        <?php } else {


            ?>
            <div class="text-4xl text-center flex justify-between"
            style=" border-bottom: solid 1px; padding-right:10px;margin-top: 10px;  height: 60px;">
            <a href="AdminDashboard.php">
                <div class="text-base   " style="margin-left: 10px;float: left;height: 40px;
    display: flex;
    align-items: center;"><i class="m-2 fa-solid fa-arrow-left"></i>Terug
                </div>
            </a>
            <div style="margin-left: 241px;">
                <?php if ($_SESSION['role'] == 1) {
                    echo "Super Beheerder Admin-Panel";
                }
                if ($_SESSION['role'] == 2) {
                    echo "Beheerder Admin-Panel";
                } ?>
            </div>
            <a href="SchoonmaaksterKoppelen.php?KamerId=<?php echo $_GET['KamerId']; ?>">
                <div class="text-base   " style="margin-left: 10px;float: right;height: 40px;
    display: flex;
    align-items: center;">Schoonmaakster Koppelen<i class="m-2 fa-solid fa-arrow-right"></i></div>
            </a>
            <?php
        }
        ?>

        </div>
    <?php } else { ?>
        <div class="text-4xl text-center  justify-between"
             style=" border-bottom: solid 1px; padding-right:10px;margin-top: 10px;  height: 60px;">
            <a href="AdminDashboard.php">
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
    <?php } ?>


    <div class="flex">
        <div class="w-1/5 text-center" style="">

            <div class="text-2xl p-5">
                Kamers
            </div>

            <div>
                <?php include "showKamer.php"; ?>
            </div>
            <div class="m-5 flex align-center justify-center">
                <a href="addKamer.php" style="border: 1px solid; color: black; padding: 10px; border-radius: 10px; ">
                    <i class="fa-solid fa-plus m-2"></i>Nieuwe Kamer
                </a>
            </div>
        </div>
        <div class="w-4/5" style="border-left: 1px black solid; min-height: 100vh; height: 100%;">
            <div>

                <?php


                if (isset($_GET['nieuweKamer'])) {
                    ?>

                    <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: green; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Kamer aangemaakt!
                    </div>
                <?php }
                if (isset($_GET['Saved'])) {
                    ?>
                    <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: green; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Aanpassingen succesvol opgeslagen!
                    </div>
                <?php }
                if (isset($_GET['taakDeleted'])) {
                    ?>
                    <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: red; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Taak verwijderd
                    </div>
                <?php }
                if (isset($_GET['KamerDeleted'])) {
                    ?>
                    <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: red; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Kamer verwijderd
                    </div>
                <?php }
                if (isset($_GET['newTaak'])) {
                    ?>
                    <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: green; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Taak(en) aangemaakt!
                    </div>
                <?php }

                if (isset($_GET['KamerId'])) {
                    include "Taken.php";
                } else {
                    ?>
                    <div class="w-3/4 h-24 text-2xl m-auto mt-5 rounded-md text-center" style="color: #000; background-color: ;display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Selecteer een kamer
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>
</div>

</body>
</html>