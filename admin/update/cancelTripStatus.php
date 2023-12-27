<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ublc_reservation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$userId = $_GET['userId'];

// $last_id = $_SESSION['last_id'];
// $user = $_SESSION["user_id"];
$sql = "UPDATE bus SET status=0 WHERE id = '$userId' ";
if (mysqli_query($conn, $sql)) {
    echo "Updated";
    header('location:../ticket.php');
    } 
    else {
    echo "Error" . mysqli_error($conn);
    }
?>