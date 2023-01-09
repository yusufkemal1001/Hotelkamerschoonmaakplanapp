<?php
include "dbcon.php";
require "loginClass.php";

// Generate a unique ID
$unique_id = uniqid();

// Set the session variable to the unique ID
$_SESSION['taakSession'] = $unique_id;



if (!isset($_GET['KamerId'])){
    header("location:CleanerDashboard.php");
}
$sqlToGetName = "Select * from Kamers where KamerId = $_GET[KamerId]; ";
$resultKamer = mysqli_query($conn,$sqlToGetName);
$resultname = mysqli_fetch_assoc($resultKamer);

$kamerName = $resultname['Naam'];
if (!isset($_SESSION['id'])){
    header("location:index.php");
}

$checkIfCompleted = "select * from opdrachten where OpdrachtId = $_GET[Opdracht] and KamerId = $_GET[KamerId]";
$resultCompleted = mysqli_query($conn,$checkIfCompleted);
$rowCompleted = mysqli_fetch_assoc($resultCompleted);

if ($rowCompleted['Eindtijd'] != NULL ){
    header("Location:CleanerDashboard.php");
}





if (!isset($_GET['Opdracht'])){
    header("location:CleanerDashboard.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/output.css">
    <script src="https://kit.fontawesome.com/a5e31d35c1.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body style="background-color: #363E44">

<div class=" w-3/4 m-auto " >
    <div class=" text-center m-5 ">
        <div class="text-2xl flex justify-center">
            <div class="w-4/5 text-white">
                <b>Schoonmaakster Taken Afvinken</b>

            </div>

        </div>
        <div class="text-center text-white text-xl">
            Kamer : <?php echo $kamerName;  ?>
        </div>
    </div>
    <div class="text-center text-white" id="stopwatch">00:00:00</div>

    <div class="w-4/5 m-auto text-center">
        <form action="saveOpdracht.php?Opdracht=<?php echo $_GET['Opdracht']; ?>&KamerId=<?php echo $_GET['KamerId']; ?>"
              method="post" style="">
            <?php
            // Connect to the database


            // Check connection

            $sql = "select Taken.Taak, Taken_Van_Kamer.`Duur`,Taken_Van_Opdrachten.NieuwDuur,Taken_Van_Opdrachten.TaakOpdrachtId, Taken_Van_Opdrachten.Afgerond from Taken_Van_Opdrachten Inner join Taken on Taken.TaakId=Taken_Van_Opdrachten.TaakId inner join Taken_Van_Kamer on Taken_Van_Kamer.TaakId = Taken_Van_Opdrachten.TaakId where Taken_Van_Opdrachten.OpdrachtId = $_GET[Opdracht] and Taken_Van_Kamer.KamerId = $_GET[KamerId]";


            $result = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result) > 0) {
                // Output the data for each row


                while ($row = mysqli_fetch_assoc($result)) { ?>


                    <div class="grid grid-cols-6 sup m-5 text-md " style="border-radius: 5px; background-color: #B3D0D0; max-width: 100%; ">
                        <b class="flex justify-center items-center col-start-1 col-span-1 p-2" >
                            <div class="text-center"><?php echo $row['Taak']; ?></div>
                        </b>
                        <div class="block p-2 col-span-4" style="">
                            <div class="grid-cols-10 grid m-2">
                                <div class="col-span-3">Duur (min) : </div><input class="col-span-6 text-black" type="number" name="oldDuur" value="<?php echo $row['Duur']; ?>"
                                                    disabled style="border: 1px solid; border-radius: 5px;"><br>
                            </div>

                            <div class="grid-cols-10 grid m-2">
                                <div class="col-start-1 flex items-center col-span-3">Nieuwe Duur (min) : </div>
                                <div class="col-span-6 flex items-center"><input type="number" name="newDuur" id="newDuur"
                                                           class="<?php echo $row['TaakOpdrachtId']; ?>"
                                                           value="<?php echo $row['NieuwDuur']; ?>"
                                                           style="border: 1px solid; border-radius: 5px;color: black; width: 100%">
                                </div>
                                <a href="deleteNieuwDuur.php?id=<?php echo $row['TaakOpdrachtId'] ?>&KamerId=<?php echo $_GET['KamerId'] ?>&Opdracht=<?php echo $_GET['Opdracht'] ?>"class="col-span1" style="margin-left: 10px; display: flex;align-items: center;" "><i
                                            class="fa-solid fa-rotate-right" ></i></a>
                            </div>
                        </div>
                        <div class="flex items-center pr-2 pl-2" style="">
                            <div class="mr-2">Afgerond:</div>
                        <input id="<?php echo $row['TaakOpdrachtId']; ?> " onclick="updateDatabase(this)"
                               type="checkbox" name="checkBox"
                               value="1" <?php if ($row['Afgerond'] == 1) { ?> checked <?php } ?> style="width: 30px; height: 30px;" >
                        </div>
                    </div>


                    <?php
                }

            }

            // Select all rows from the table


            ?>
            <br>
            <div class="text-center text-white">
            Opmerking<br>
            <textarea name="textInput" id="" cols="30" rows="3" disabled class="text-black rounded-md mb-5" style="border:1px solid; "></textarea>
            </div>
            <script>
                // Initialize the stopwatch
                let elapsedTime = 0;
                let interval;

                // Start the stopwatch
                function startStopwatch() {
                    interval = setInterval(function() {
                        // Increment the elapsed time
                        elapsedTime++;

                        // Calculate the hours, minutes, and seconds
                        let hours = Math.floor(elapsedTime / 3600);
                        let minutes = Math.floor((elapsedTime % 3600) / 60);
                        let seconds = elapsedTime % 60;

                        // Display the elapsed time in the format HH:MM:SS
                        document.getElementById('stopwatch').innerHTML =
                            hours.toString().padStart(2, '0') + ':' +
                            minutes.toString().padStart(2, '0') + ':' +
                            seconds.toString().padStart(2, '0');

                        // Save the elapsed time in local storage
                        localStorage.setItem('elapsedTime', elapsedTime);
                    }, 1000);
                }

                // Stop the stopwatch
                function stopStopwatch() {
                    clearInterval(interval);
                }

                // Reset the stopwatch
                function resetStopwatch() {
                    // Stop the stopwatch
                    stopStopwatch();

                    // Reset the elapsed time
                    elapsedTime = 0;

                    // Display the elapsed time in the format HH:MM:SS
                    document.getElementById('stopwatch').innerHTML = '00:00:00';

                    // Remove the elapsed time from local storage
                    localStorage.removeItem('elapsedTime');
                }

                // Start the stopwatch when the webpage is loaded
                window.onload = function() {
                    // Check if the elapsed time is saved in local storage
                    let savedTime = localStorage.getItem('elapsedTime');
                    if (savedTime) {
                        // Set the elapsed time to the saved value
                        elapsedTime = parseInt(savedTime);

                        // Calculate the hours, minutes, and seconds
                        let hours = Math.floor(elapsedTime / 3600);
                        let minutes = Math.floor((elapsedTime % 3600) / 60);
                        let seconds = elapsedTime % 60;

                        // Display the elapsed time in the format HH:MM:SS
                        document.getElementById('stopwatch').innerHTML =
                            hours.toString().padStart(2, '0') + ':' +
                            minutes.toString().padStart(2, '0') + ':' +
                            seconds.toString().padStart(2, '0');
                    }

                    // Start the stopwatch
                    startStopwatch();

                    // Add an event listener to the reset button
                    document.getElementById('reset-button').addEventListener('click', resetStopwatch);
                }
            </script>
            <button type="submit" name="submit" id="reset-button" onclick="resetStopwatch()" disabled class=" text-white rounded-md p-2 mb-5" style="border: 1px solid;">Versturen</button>
<!--            <button type="submit" name="submit" id="reset-button" onclick="resetStopwatch()" disabled class=" text-white rounded-md p-2 mb-5" style="border: 1px solid;">Submit</button>-->
        </form>
    </div>
</div>


<!-- JavaScript -->


<script>
    var checkboxes = document.querySelectorAll('input[type=checkbox]');
    var button = document.querySelector('button');
    var textinput = document.querySelector('textarea');

    function checkAllCheckboxes() {
        for (var i = 0; i < checkboxes.length; i++) {
            if (!checkboxes[i].checked) {
                return false;
            }
        }
        return true;
    }

    function updateForm() {
        if (checkAllCheckboxes()) {
            button.disabled = false;
            textinput.disabled = false;
            button.style.backgroundColor = '#62ba46';
            button.style.color = 'white';
        } else {
            button.disabled = true;
            textinput.disabled = true;
            button.style.backgroundColor = '#363E44';
            button.style.color = 'white';
        }
    }

    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('click', updateForm);
    }


</script>
<script>
    // Function to send an AJAX request to the server to update the database
    function updateDatabase(checkbox) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_database.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Database update successful');
            } else {
                console.log('Error updating database');
            }
        };
        // Check if the checkbox is checked or unchecked
        if (checkbox.checked) {
            // Send the value 1 to the server

            xhr.send('value=1' + '&id=' + checkbox.id);

        } else {
            // Send the value 0 to the server

            xhr.send('value=0' + '&id=' + checkbox.id);

        }
    }


    const inputs = document.querySelectorAll('input[type="number"]');

    // Iterate over the input fields using a forEach loop
    inputs.forEach((input) => {
        // Add an event listener to the input field to handle change events
        input.addEventListener('change', (event) => {
            // Get the value of the input field
            const number = input.value;
            const id = input.className;
            // Send an AJAX request to the server to update the MySQL database
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_Duur.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = () => {
                if (xhr.status === 200) {
                    // Do something with the response from the server, such as displaying a message to the user
                    sup
                } else {
                    // Do something with the error, such as displaying an error message to the user
                    no
                }
            };
            xhr.send(`number=${encodeURIComponent(number)}` + '&id=' + id);
        });
    });

</script>

</body>
</html>








