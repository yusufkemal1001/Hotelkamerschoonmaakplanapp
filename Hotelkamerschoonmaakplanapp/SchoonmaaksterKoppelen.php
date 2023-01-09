<?php
include "dbcon.php";
require_once "loginClass.php";
if (!isset($_GET['KamerId'])) {
    header("location:AdminDashboard.php");
}

$sql = "select * from Opdrachten where KamerId = $_GET[KamerId] and Datum=CURDATE()";
$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result)>1){
    header("location:Kamers.php?KamerId=$_GET[KamerId]");
}

?>


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


    <div class="text-4xl text-center"
         style=" border-bottom: solid 1px; padding-right:10px;margin-top: 10px;  height: 60px;">
        <a href="deleteOpdracht.php?KamerId=<?php echo $_GET['KamerId'];?>">
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
        <div class="text-3xl text-center p-5">
            Schoonmaaksters Koppelen
        </div>
        <div class="grid grid-cols-2" style="">
            <div>
                <?php include "koppelForm.php"; ?>

            </div>
            <div class="m-5 ">
                <?php include "shoonmaakstersZien.php"?>
            </div>
        </div>


    </div>
</div>

</body>
</html>
