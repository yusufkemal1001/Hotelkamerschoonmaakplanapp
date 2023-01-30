<?php
require "loginClass.php";
include "dbcon.php";
//require_once "startTaakSession.php";
if (isset($_SESSION['Login'])) {
    header("location:CleanerDashboard.php");
}

//if (isset($_SESSION['taakSession'])){
//    header("location:CleanerDashboard.php?sessionidisset");
//}

if ($_SESSION['role'] != 3){
    header("Location:AdminDashboard.php");
}

$select = new Select();
if (isset($_SESSION["id"])) {
    $userid = $select->selectUserById($_SESSION["id"]);
} else {
    header("location: index.php");
}
//if ()

if (isset($_GET['KamerId'])){
 $sql = "select Naam from Kamers where KamerId = $_GET[KamerId]";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_assoc($result);
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
<div class="container w-3/4 m-auto">
    <div class=" text-center m-5 ">
        <div class="text-2xl flex justify-center">
            <div class="w-4/5  " style="margin-left: 30px;">
                <b>Schoonmaak(st)er Home-pagina</b>
            </div>
            <a href="logout.php" ">
                <div class="text-base   " style="float: right;    height: 40px;
    display: flex;
    align-items: center;"><i class="fa-solid fa-right-from-bracket m-2"></i></div>
            </a>
        </div>
        <div class="text-2xl m-auto w-5/5">
            Welkom <?php echo $userid['Naam']; ?>
        </div>


    </div>
    <div class="main text-center m-auto">
        <?php if (isset($_GET['OpdrachtDone'])){?>
        <div class="pr-5 pb-5 pl-5 text-green-600"><?php echo $row['Naam']; ?> is schoongemaakt!
        </div>
        <?php }?>

        <?php include "showOpdrachten.php"; ?>
    </div>

</div>
</body>
</html>
