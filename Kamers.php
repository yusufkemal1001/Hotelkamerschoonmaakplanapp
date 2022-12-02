<?php
require_once "loginClass.php";
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
    <div class="text-4xl text-center" style=" border-bottom: solid 1px; padding-right:10px;margin-top: 10px;  height: 60px;">
        <?php if ($_SESSION['role']==1){
            echo "Super Beheerder Admin-Panel";
        }if ($_SESSION['role']==2){
            echo "Beheerder Admin-Panel";
        }?>


        <a href="AdminDashboard.php" style="border-bottom: 1px solid; "><div class="text-base   " style="margin-left: 10px;float: left;height: 40px;
    display: flex;
    align-items: center;"><i class="m-2 fa-solid fa-arrow-left"></i>Terug</div></a>

    </div>
    <div class="flex">
    <div class="w-1/5 text-center" style="border-right: 1px black solid; min-height: 100vh; height: 100%;">
        <div class="text-2xl p-5">
            Kamers
        </div>
        <div>
            <?php include "showKamers.php";?>
        </div>
        <div class="m-5 flex align-center justify-center">
            <a href="addKamer.php">
            Nieuwe Kamer<i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="w-4/5">
        <div>

        <?php
        if (isset($_GET['nieuweKamer'])){?>
            <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: green; display: flex;
    justify-content: center;
    align-items: center;">Kamer aangemaakt!</div>
        <?php }


        if (isset($_GET['KamerId'])){
            include "showTaken.php";
            echo "sup";
            echo $_GET["KamerId"];
        }else{?>
            <div class="w-3/4 h-24 text-2xl m-auto mt-5 rounded-md text-center" style="color: #000; background-color: ;display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Selecteer een kamer</div>
        <?php } ?>


        </div>
    </div>
    </div>
</div>

</body>
</html>