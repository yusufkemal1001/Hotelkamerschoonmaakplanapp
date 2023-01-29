<?php
require_once 'loginClass.php';
include "dbcon.php";
//if (!isset($_SESSION['id'])){
//    header("location:index.php");
//}else{
//
//}
$select = new Select();
if (isset($_SESSION["id"])) {
    $userid = $select->selectUserById($_SESSION['id']);
    $userrole = $select->selectUserById($_SESSION['role']);
} else {
    header("location: index.php");
}
if ($_SESSION['role'] == 3) {
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
    <script src="https://kit.fontawesome.com/a5e31d35c1.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="container w-3/4 m-auto">
    <div class=" text-center m-5 ">
        <style>
            #notification-box {
                position: absolute; /* position the box absolutely */
                left: 5%;
                width:350px; /* align the box to the left of the toggle button */
                top: 80px; /* position the box 40px below the toggle button */
                background-color: #fff; /* set the background color of the box */
                padding: 20px; /* add some padding to the box */
                border: 1px solid #ccc; /* add a border to the box */
                z-index: 1; /* set the z-index to 1 to make sure it's in front of other elements */
            }


        </style>

        <div class="text-4xl" style="">
            <div class="text-base" style="float:left; margin-right: 100px;">
                <div class="sup">
                    <div class="flex">

                        <button id="notification-button"><i class="fa-regular text-xl fa-bell "></i></button>
                        <span id="dot" class="dot bg-red-500 "
                              style="height: 5px;margin-top: 5px; width: 5px;display:none; border-radius: 50%;">

                    </span>
                    </div>
                    <div id="notification-box" style="display:none;">

                        <div id="parentDiv">
                            <?php include "notifications.php" ?>
                            <h3 id="noChildrenText" style="display:none;">Geen nieuwe meldingen</h3>
                            <script>
                                // var parentDiv = document.getElementById("parentDiv");
                                // var noChildrenText = document.getElementById("noChildrenText");
                                const noChildrenText = document.getElementById("noChildrenText");
                                const parentDiv = document.querySelector("#parentDiv");
                                const childDivs = parentDiv.querySelectorAll("div");
                                const childDivCount = childDivs.length;
                                const dot = document.getElementById("dot")
                                console.log(childDivCount);
                                if (childDivCount === 0) {
                                    noChildrenText.style.display = "block";
                                    // parentDiv.innerHTML = "There are no child divs.";
                                    dot.style.display = "none";
                                } else {
                                    noChildrenText.style.display = "none";
                                    dot.style.display = "block";
                                }

                            </script>
                        </div>
                    </div>

                </div>
            </div>

            <?php if ($_SESSION['role'] == 1) {

                echo "Super Beheerder Admin-Panel";
            }
            if ($_SESSION['role'] == 2) {
                echo "Beheerder Admin-Panel";
            } ?>


            <a href="logout.php">
                <div class="text-base   " style="float: right;    height: 40px;
    display: flex;
    align-items: center;">Uitloggen<i class="fa-solid fa-right-from-bracket m-2"></i></div>
            </a>

        </div>
        <div class="text-2xl">
            Welkom <?php echo $userid['Naam']; ?>
        </div>

        <script>
            var button = document.getElementById("notification-button");
            var box = document.getElementById("notification-box");

            button.addEventListener("click", function () {
                if (box.style.display === "none") {
                    box.style.display = "block";
                    button.style.color = "#4D7C8A";
                } else {
                    box.style.display = "none";
                    button.style.color = "#000";
                }
            });
        </script>

    </div>
    <div class="main text-center m-auto">
        <?php if (isset($_GET['KamerGekoppeld'])) { ?>
            <div class=" text-md m-auto mt-5 rounded-md text-center" style="color: green; display: flex;
    justify-content: center;
    align-items: center;"><i class="fa-solid fa-circle-exclamation m-2"></i>Kamer is gekoppeld!
            </div>
        <?php } ?>
        <?php if ($_SESSION['role'] == 1) { ?>
            <div class="grid grid-cols-3 ">
                <a href="Kamers.php" class="text-3xl p-5 m-2"
                   style="height: 200px; display: flex;align-items: center;justify-content: center;border: 1px solid; border-radius: 10px;">
                    Kamers
                </a>

                <a href="accounts.php" class="text-3xl p-5 m-2"
                   style="height: 200px; display: flex;align-items: center;justify-content: center; border: 1px solid; border-radius: 10px;">
                    Accounts
                </a>
                <a href="allMeldingen.php" class="text-3xl p-5 m-2"
                   style="height: 200px; display: flex;align-items: center;justify-content: center; border: 1px solid; border-radius: 10px;">
                    Meldingen
                </a>

            </div>
        <?php } else { ?>
            <div class="grid grid-cols-2 ">
                <a href="Kamers.php" class="text-3xl p-5 m-2"
                   style="height: 200px; display: flex;align-items: center;justify-content: center;border: 1px solid; border-radius: 10px;">
                    Kamers
                </a>
                <a href="allMeldingen.php" class="text-3xl p-5 m-2"
                   style="height: 200px; display: flex;align-items: center;justify-content: center; border: 1px solid; border-radius: 10px;">
                    Meldingen
                </a>
            </div>
        <?php } ?>
        <div class="meldingen">
            <?php
            $sql = "select * from Opdrachten where Eindtijd is not NULL";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                include "lastMeldingen.php";
            }
            ?>

        </div>
    </div>

</div>
</body>
</html>
