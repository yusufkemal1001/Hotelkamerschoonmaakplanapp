<?php
include "dbcon.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape the received values to prevent SQL injection
    $value = mysqli_real_escape_string($conn, $_POST['number']);
    $id =  mysqli_real_escape_string($conn, $_POST['id']);

    echo $id;
    // Update the database
    $sql = "UPDATE Taken_Van_Opdrachten SET NieuwDuur = '$value' where TaakOpdrachtId = '$id' ";
    if (mysqli_query($conn, $sql)) {
        echo 'Success';
    } else {
        echo 'Error';
    }
}




?>