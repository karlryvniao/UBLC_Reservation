<?php
include '../session1.php';


$host = "localhost";
$user = "root";
$password = "";
$db = "ublc_reservation";
try {

  $con = new PDO("mysql:dbname=$db;port=3306;host=$host", 
  	$user, $password);
  // set the PDO error mode to exception
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: ".
   $e->getMessage();
  echo $e->getTraceAsString();
  exit;
}

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    //$passengerName = explode(",", $_POST['pass_name']);
    $loc = $_POST['location'];
    $DateDeparture = $_POST['date_departure'];
    $TimeDeparture = $_POST['time_departure'];
    $DateArrival = $_POST['exp_arrival'];
    $TimeReturn = $_POST['time_arrival'];
    $Passengers = $_POST['passengers'];
    $Purpose = $_POST['purpose'];
    $DestName = $_POST['destination_name'];
    $Status = $_POST['status'];
    $sessionUsername = $_SESSION['username'];
    

    //Selecting Bus
    $SelectedBus = isset($_POST['bus']) ? $_POST['bus'] : [];
    $BusesString = implode(", ", $SelectedBus);

    //Selecting passenger name
    $passengerNames = $_POST['passengerNames']; // This is now an array

    // Assuming you want to store passenger names as a comma-separated string
    $passengerNamesString = implode(',', $passengerNames);

    // File handling (assuming 'template_name' is the name attribute of the file input)
    $approvalFile = $_FILES["template_name"]["name"];
    $uploadDir = "approval_file/"; // Specify the directory where you want to store uploaded files
    $targetFile = $uploadDir . basename($_FILES["template_name"]["name"]);

   // Move the uploaded file to the specified directory
    move_uploaded_file($_FILES["template_name"]["tmp_name"], $targetFile);
    
    $existingReservations = [];
    foreach ($SelectedBus as $bus) {
        $checkQuery = "SELECT COUNT(*) as count FROM bus
                      WHERE bus = :bus
                      AND (date_departure <= :exp_arrival AND exp_arrival >= :date_departure)
                      AND (time_departure <= :time_arrival AND time_arrival >= :time_departure)";
        
        $checkStmt = $con->prepare($checkQuery);
        $checkStmt->bindParam(':bus', $bus);
        $checkStmt->bindParam(':date_departure', $DateDeparture);
        $checkStmt->bindParam(':time_departure', $TimeDeparture);
        $checkStmt->bindParam(':exp_arrival', $DateArrival);
        $checkStmt->bindParam(':time_arrival', $TimeReturn);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Existing reservation found for the current bus
            $existingReservations[] = $bus;
        }
    }

    if (!empty($existingReservations)) {
        // Existing reservation found for one or more buses
        $message = "The selected date range overlaps with an existing reservation for bus(es) " . implode(', ', $existingReservations) . ". Please choose a different date, time, and bus.";
    } else {
    $stmt = $con->prepare("INSERT INTO bus (name, department, pass_name, location, bus,
    date_departure, time_departure, exp_arrival, time_arrival, passengers, purpose, destination_name,
    file_name, status, session_username) VALUES (:name, :department, :pass_name, :location, :bus,
    :date_departure, :time_departure, :exp_arrival, :time_arrival, :passengers, :purpose, :destination_name,
    :file_name, :status, :session_username)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':pass_name', $passengerNamesString);
    $stmt->bindParam(':location', $loc);
    $stmt->bindParam(':bus', $BusesString);
    $stmt->bindParam(':date_departure', $DateDeparture);
    $stmt->bindParam(':time_departure', $TimeDeparture);
    $stmt->bindParam(':exp_arrival', $DateArrival);
    $stmt->bindParam(':time_arrival', $TimeReturn);
    $stmt->bindParam(':passengers', $Passengers);
    $stmt->bindParam(':purpose', $Purpose);
    $stmt->bindParam(':destination_name', $DestName);
    $stmt->bindParam(':file_name', $targetFile);
    $stmt->bindParam(':status', $Status);
    $stmt->bindParam(':session_username', $sessionUsername);
    
    
    // Execute the query
    $stmt->execute();

    // Redirect to a success page or do something else
    $message = "Reservation successful!";
    header("Location: ../home.php");
    exit;
}
}
?>