<?php
include "dbcon.php";
include "loginClass.php";
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
if ($_SESSION['role'] == 3) {
    header("location:CleanerDashboard.php");
}
$sql = "Select * from User where exists (
select * from Opdrachten where Datum=Curdate() and Opdrachten.UserId = User.UserId

)";

$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result)
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<style>
    .checkbox-wrapper-16 *,
    .checkbox-wrapper-16 *:after,
    .checkbox-wrapper-16 *:before {
        box-sizing: border-box;
    }

    .checkbox-wrapper-16 .checkbox-input {
        clip: rect(0 0 0 0);
        -webkit-clip-path: inset(100%);
        clip-path: inset(100%);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }
    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile {
        border-color: #2260ff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        color: #2260ff;
    }
    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile:before {
        transform: scale(1);
        opacity: 1;
        background-color: #2260ff;
        border-color: #2260ff;
    }
    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile .checkbox-icon,
    .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile .checkbox-label {
        color: #2260ff;
    }
    .checkbox-wrapper-16 .checkbox-input:focus + .checkbox-tile {
        border-color: #2260ff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
    }
    .checkbox-wrapper-16 .checkbox-input:focus + .checkbox-tile:before {
        transform: scale(1);
        opacity: 1;
    }

    .checkbox-wrapper-16 .checkbox-tile {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 7rem;
        min-height: 7rem;
        border-radius: 0.5rem;
        border: 2px solid #b5bfd9;
        background-color: #fff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        transition: 0.15s ease;
        cursor: pointer;
        position: relative;
    }
    .checkbox-wrapper-16 .checkbox-tile:before {
        content: "";
        position: absolute;
        display: block;
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid #b5bfd9;
        background-color: #fff;
        border-radius: 50%;
        top: 0.25rem;
        left: 0.25rem;
        opacity: 0;
        transform: scale(0);
        transition: 0.25s ease;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
        background-size: 12px;
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }
    .checkbox-wrapper-16 .checkbox-tile:hover {
        border-color: #2260ff;
    }
    .checkbox-wrapper-16 .checkbox-tile:hover:before {
        transform: scale(1);
        opacity: 1;
    }

    .checkbox-wrapper-16 .checkbox-icon {
        transition: 0.375s ease;
        color: #494949;
    }
    .checkbox-wrapper-16 .checkbox-icon svg {
        width: 3rem;
        height: 3rem;
    }

    .checkbox-wrapper-16 .checkbox-label {
        color: #707070;
        transition: 0.375s ease;
        text-align: center;
    }
</style>
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
<div class="text-xl text-center mt-5">Schoonmaak(st)er Overzicht<br>
    <small class="text-xs m-auto">Klik op een schoonmaak(st)er om zijn/haar planning te zien</small>
</div>

<div class="grid  grid-cols-6 mt-5 text-center">
    <?php foreach ($result as $row){?>
        <div class="checkbox-wrapper-16 mr-5 ml-5">
            <label class="checkbox-wrapper">
                <input type="checkbox" class="checkbox-input" value="<?php echo $row['UserId'] ?>">
                <span class="checkbox-tile m-auto">
                    <span class="checkbox-label"><?php echo $row['Naam'] ?></span>
                </span>
            </label>
        </div>

    <?php } ?>

</div>
<div id="data-container" >

</div>

<script>
    $(document).ready(function() {
        $('input[type=checkbox]').change(function() {
            if(this.checked) {
                // Send AJAX request to server with value of checkbox
                $.ajax({
                    type: "POST",
                    url: "planning.php",
                    data: {value: this.value},
                    success: function(response) {
                        // Use returned data to update page
                        $('#data-container').append(response);
                    }
                });
            } else {
                // Hide data from page
                $('#data-container').find('[data-value='+this.value+']').remove();
            }
        });
    });
</script>
</body>
</html>
