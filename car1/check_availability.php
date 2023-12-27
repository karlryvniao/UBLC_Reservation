<?php
// Include database connection or any necessary setup
include './config/connection.php';

// Get parameters from the AJAX request
$busNumber = $_GET['bus'];
$dateDeparture = $_GET['date_departure'];
$timeDeparture = $_GET['time_departure'];
$dateArrival = $_GET['exp_arrival'];
$timeArrival = $_GET['time_arrival'];

// Check for existing reservations for the selected bus, date, and time range
$checkQuery = "SELECT COUNT(*) as count FROM bus
            WHERE bus = :bus
            AND NOT ((date_departure > :returning_date) OR (exp_arrival < :date_departure) OR (time_departure > :time_arrival) OR (time_arrival < :time_departure))";
$checkStmt = $con->prepare($checkQuery);
$checkStmt->bindParam(':bus', $busNumber);
$checkStmt->bindParam(':date_departure', $dateDeparture);
$checkStmt->bindParam(':time_departure', $timeDeparture);
$checkStmt->bindParam(':returning_date', $dateArrival);
$checkStmt->bindParam(':time_arrival', $timeArrival);
$checkStmt->execute();
$result = $checkStmt->fetch(PDO::FETCH_ASSOC);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode(['available' => $result['count'] === 0]);
?>