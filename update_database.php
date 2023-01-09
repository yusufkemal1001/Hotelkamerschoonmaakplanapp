<?php
include "dbcon.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape the received values to prevent SQL injection
    $value = mysqli_real_escape_string($conn, $_POST['value']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Update the database
    $sql = "UPDATE Taken_Van_Opdrachten SET Afgerond = '$value' WHERE TaakOpdrachtId = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo 'Success';
    } else {
        echo 'Error';
    }
}




?>