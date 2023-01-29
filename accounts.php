<?php
require_once "loginClass.php";
if ($_SESSION['role']==3){
    header("location:CleanerDashboard.php");
}
if ($_SESSION['role']==2){
    header("location:AdminDashboard.php");
}
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
    <div class="text-4xl text-center"
         style=" border-bottom: solid 1px; padding-right:10px;margin-top: 10px;  height: 60px;">
        <a href="AdminDashboard.php">
            <div class="text-base   " style="margin-left: 10px;float: left;height: 40px;
    display: flex;
    align-items: center;"><i class="m-2 fa-solid fa-arrow-left"></i>Terug
            </div>
        </a>
        <div style="margin-right: 80px;">
            <?php if ($_SESSION['role'] == 1) {
                echo "Super Beheerder Admin-Panel";
            }
            if ($_SESSION['role'] == 2) {
                echo "Beheerder Admin-Panel";
            } ?>
        </div>
    </div>
    <div class="container m-auto">
        <div class="text-3xl mt-10 text-center">
            Accounts Beheren

        </div>
        <?php
        if (isset($_GET['userDeleted'])) {
            ?>

            <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: red; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Account verwijderd
            </div>
        <?php }
        if (isset($_GET['wrongEmail'])) {
            ?>

            <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: red; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Deze e-mail bestaat niet. Voer een geldige
                e-mail in
            </div>
        <?php }
        if (isset($_GET['newAccount'])) {
            ?>

            <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: green; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Account aangemaakt!
            </div>
        <?php }
        if (isset($_GET['existingEmail'])) {
            ?>

            <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: red; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Deze e-mail is al in gebruik. Voer een
                andere e-mail in
            </div>
        <?php }
        ?>
        <div class="grid grid-cols-2 m-5">
            <div class="text-2xl text-center ">
                <b>Beheerders</b>
                <div class="text-md">
                    <?php include "selectBeheerders.php"; ?>
                </div>
            </div>
            <div class="text-2xl text-center">
                <b>Schoonmaak(st)ers</b>
                <div class="text-md">
                    <?php include "selectSchoonmaaksters.php"; ?>
                </div>
            </div>

        </div>
        <div class="mt-10">
            <?php include "newAccount.php"; ?>
        </div>
    </div>
</div>

</body>
</html>