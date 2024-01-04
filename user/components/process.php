<?php

include '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a column named 'status' in your 'bus' table
    $newStatus = $_POST['status'];

    // Assuming you have a column named 'id' to uniquely identify each trip
    $tripId = $_POST['trip_id'];

    try {
        // Update the status in the database
        $updateQuery = "UPDATE bus SET status = :status WHERE id = :id";
        $stmtUpdate = $con->prepare($updateQuery);
        $stmtUpdate->bindParam(':status', $newStatus);
        $stmtUpdate->bindParam(':id', $tripId);
        $stmtUpdate->execute();

        // Provide a response to the client
        echo 'Status successfully updated to ' . $newStatus;
    } catch (PDOException $ex) {
        // Handle database errors
        echo 'Error updating status: ' . $ex->getMessage();
    }
} else {
    // Invalid request method
    echo 'Invalid request method';
}
?>
