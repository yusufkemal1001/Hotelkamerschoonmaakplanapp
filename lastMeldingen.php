<?php
include "dbcon.php";
require_once 'loginClass.php';

$sql = "select OpdrachtId,UserId,KamerId,Starttijd,Eindtijd,VerwachtteEindtijd,DATE_FORMAT(Datum,'%d-%m-%Y') as Datum,Opmerking from Opdrachten where Eindtijd is Not Null order by OpdrachtId  desc LIMIT 5 ";
//$sql1 = "select OpdrachtId,UserId,KamerId,Starttijd,Eindtijd,VerwachtteEindtijd,DATE_FORMAT(Datum,'%d-%m-%Y') as Datum,Opmerking from Opdrachten where Eindtijd is Not Null and Datum = CURDATE() and Eindtijd> CURTIME() - interval 15 minute order by OpdrachtId  desc  ";
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css-table-17/fonts/icomoon/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css-table-17/css/owl.carousel.min.css">
    <script src="https://kit.fontawesome.com/a5e31d35c1.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css-table-17/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/output.css">
    <!-- Style -->
    <link rel="stylesheet" href="css-table-17/css/style.css">

    <title>Table #7</title>
</head>
<body onload="doRefresh()">



<div class=" text-center mt-5">
    <div class="text-2xl text-center">

        Meldingen

    </div>

</div>

<div id="container" class="container">
<!--    --><?php
//    foreach (mysqli_query($conn,$sql1) as $lastMelding){
//        $newKamerMelding="select Naam from Kamers where KamerId=$lastMelding[KamerId] ";
//        $resultNewMelding= mysqli_query($conn,$newKamerMelding);
//        $rowNewMelding = mysqli_fetch_assoc($resultNewMelding);?>
<!--        <div class="flex justify-center">-->
<!--            <div class=" text-green-500 text-center">-->
<!--                --><?php //echo  $rowNewMelding['Naam'];?><!-- is schoongemaakt!-->
<!--            </div>-->
<!--            --><?php //if ($lastMelding['Eindtijd'] > $lastMelding['VerwachtteEindtijd']){?>
<!--                &nbsp;&nbsp;<div class="text-red-500 text-center">-->
<!--                    --><?php //echo  $rowNewMelding['Naam'];?><!-- is te laat schoongemaakt!-->
<!--                </div>-->
<!--            --><?php //}?>
<!--        </div>-->
<!---->
<!---->
<!---->
<!--    --><?php //}
//
//    ?>

    <div class="table-responsive">

        <table class="table table-striped custom-table">
            <thead>
            <tr>
                <th scope="col">Kamer</th>
                <th scope="col">Schoonmaak(st)er</th>
                <th scope="col">Datum</th>
                <th scope="col">Starttijd</th>
                <th scope="col">Verwachtte eindtijd</th>
                <th scope="col">Eindtijd</th>
                <th scope="col">Opmerking</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach (mysqli_query($conn,$sql) as $row){
                $getUsers="select * from User where UserId = $row[UserId]";
                $resultUsers = mysqli_query($conn,$getUsers);
                $rowUser = mysqli_fetch_assoc($resultUsers);
                $getKamer="select * from Kamers where KamerId = $row[KamerId]";
                $resultKamer = mysqli_query($conn,$getKamer);
                $rowKamer = mysqli_fetch_assoc($resultKamer);
                ?>
                <tr scope="row">


                    <td >
                        <div class="d-flex  align-items-center justify-center" >
                            <?php if ($row['Eindtijd'] > $row['VerwachtteEindtijd']){?>
                                <i class="fa-solid fa-circle-exclamation text-red-500 mr-2"></i>
                            <?php }


                            echo $rowKamer['Naam'];?>
                        </div>
                    </td>
                    <td>
                        <?php echo $rowUser['Naam'];?>

                    </td>
                    <td><?php echo $row['Datum'];?></td>
                    <td><?php echo $row['Starttijd'];?></td>
                    <td><?php echo $row['VerwachtteEindtijd'];?></td>
                    <td><?php echo $row['Eindtijd'];?></td>

                    <td>

                        <small class="d-block"><?php echo $row['Opmerking'];?></small>
                    </td>
                    <td><a href="details.php?Opdracht=<?php echo $row['OpdrachtId'];?>&KamerId=<?php echo $rowKamer['KamerId'] ?>" class="more">Details</a></td>

                </tr>
            <?php }   ?>
            </tbody>
        </table>
        <div class="float-right m-2">
         <a href="allMeldingen.php">alle meldingen zien  <i class="fa-solid fa-arrow-right-long"></i></a>
        </div>
    </div>


</div>




<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<script>
    function doRefresh() {
        $("#container").load(" #container");
        setTimeout(doRefresh, 1000);
    }
</script>