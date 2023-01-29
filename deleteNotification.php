<?php
include "dbcon.php";
session_start();
echo $_SESSION['id'];
$sql = "select Notificatie from Opdrachten where OpdrachtId = $_GET[OpdrachtId]";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$array = unserialize($row['Notificatie']);

if (($key = array_search($_SESSION['id'], $array)) !== false) {
    unset($array[$key]);
}
// receive the array from the AJAX call

$updatedArray = serialize($array);
// serialize the array to store it as a string in the database


// update the database with the new array
$sql1 = "UPDATE Opdrachten SET Notificatie = '$updatedArray' WHERE OpdrachtId = $_GET[OpdrachtId]";
$result1 = mysqli_query($conn, $sql1);

// check if update was successful
if ($result1) {
    echo 'Array updated successfully';
} else {
    echo 'Error updating array';
}
?>