<?php
include "dbcon.php";
require_once 'loginClass.php';
$sql = "select * from Opdrachten where Eindtijd is Not Null order by OpdrachtId desc ";

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

    <link rel="stylesheet" href="css-table-17/css/owl.carousel.min.css">
    <script src="https://kit.fontawesome.com/a5e31d35c1.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css-table-17/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/output.css">
    <!-- Style -->
    <link rel="stylesheet" href="css-table-17/css/style.css">

    <title>Table #7</title>
</head>
<body>



    <div class=" text-center m-5 ">
        <a href="AdminDashboard.php">
            <div class="text-base   " style="margin-left: 10px;float: left;height: 40px;
    display: flex;
    align-items: center;"><i class="m-2 fa-solid fa-arrow-left"></i>Terug
            </div>
        </a>
        <div class="text-4xl" style="    margin-right: 50px;"><?php if ($_SESSION['role']==1){
                echo "Super Beheerder Admin-Panel";
            }if ($_SESSION['role']==2){
                echo "Beheerder Admin-Panel";
            }?>




        </div>
        <div class="text-2xl text-center">
            Meldingen
        </div>



    </div>

    <div class="container">


        <div class="table-responsive">

            <table class="table table-striped custom-table">
                <thead>
                <tr>


                    <th scope="col">Kamer</th>
                    <th scope="col">Schoonmaakster</th>
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


                    <td class="pl-0">
                        <div class="d-flex ml-2 align-items-center">
                            <?php echo $rowKamer['Naam'];?>
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
        </div>


    </div>




<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>