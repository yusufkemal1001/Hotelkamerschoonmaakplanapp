<?php


    // If the session variable is not set, check if the button has been clicked
session_start();
        // Generate a unique ID
        $unique_id = uniqid();

        // Set the session variable to the unique ID
        $_SESSION['taakSession'] = $unique_id;

        // Redirect the user to the second page
//header("location:takenAfvinken.php?KamerId=$_GET[KamerId]&Opdracht=$_GET[Opdracht]&id=$_SESSION[taakSession]");












?>