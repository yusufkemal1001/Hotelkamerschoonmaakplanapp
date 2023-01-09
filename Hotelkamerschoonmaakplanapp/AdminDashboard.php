<?php
require_once 'loginClass.php';
//if (!isset($_SESSION['id'])){
//    header("location:index.php");
//}else{
//
//}
$select = new Select();
if (isset($_SESSION["id"])){
    $userid = $select->selectUserById($_SESSION['id']);
    $userrole = $select->selectUserById($_SESSION['role']);
}else{
    header("location: index.php");
}
if ($_SESSION['role'] == 3){
    header("Location:CleanerDashboard.php");
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
    <div class="text-4xl" style="    margin-left: 130px;"><?php if ($_SESSION['role']==1){
        echo "Super Beheerder Admin-Panel";
    }if ($_SESSION['role']==2){
        echo "Beheerder Admin-Panel";
    }?>


            <a href="logout.php"><div class="text-base   " style="float: right;    height: 40px;
    display: flex;
    align-items: center;">Uitloggen<i class="fa-solid fa-right-from-bracket m-2"></i></div></a>

    </div>
    <div class="text-2xl">
        Welkom <?php echo $userid['Naam'];?>
    </div>



</div>
    <div class="main text-center m-auto">
        <?php if (isset($_GET['KamerGekoppeld'])){?>
            <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: green; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Kamer is gekoppeld!</div>
       <?php } ?>
        <?php if ($_SESSION['role']==1){?>
        <div class="grid grid-cols-2 ">
            <a href="Kamers.php" class="text-3xl p-5 m-2" style="height: 200px; display: flex;align-items: center;justify-content: center;border: 1px solid; border-radius: 10px;">
                Kamers
            </a>

            <a href="accounts.php" class="text-3xl p-5 m-2" style="height: 200px; display: flex;align-items: center;justify-content: center; border: 1px solid; border-radius: 10px;">
                Accounts
            </a>

        </div>
        <?php }else{?>
            <div class=" p-5">
                <a href="Kamers.php" class="text-3xl p-5 m-5" style="height: 200px; display: flex;align-items: center;justify-content: center; background-color: cadetblue;">
                    Kamers
                </a>
            </div>
        <?php }?>
        <div class="meldingen">
            <?php include "lastMeldingen.php"; ?>
        </div>
    </div>

</div>
</body>
</html>
