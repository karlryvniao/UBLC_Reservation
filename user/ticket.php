<?php
session_start();
include '../session1.php';
$user = $_SESSION['user'];
if(isset($_SESSION['submit'])) {
  $name = $_SESSION['name'];
  $department = $_SESSION['department'];
  $passengerName = explode(",", $_SESSION['pass_name']);
  $loc = $_SESSION['location'];
  $DateDeparture = $_SESSION['date_departure'];
  $TimeDeparture = $_SESSION['time_departure'];
  $DateArrival = $_SESSION['exp_arrival'];
  $TimeReturn = $_SESSION['time_arrival'];
  $Passengers = $_SESSION['passengers'];
  $Purpose = $_SESSION['purpose'];
  $DestName = $_SESSION['destination_name'];
  $DestName = $_SESSION['destination_name'];
  $status = $_SESSION['status'];

  //Selecting Bus
  $SelectedBus = isset($_SESSION['bus']) ? $_SESSION['bus'] : [];
  $BusString = implode(", ", $SelectedBus);

  //Selecting passenger name
  $passengerNames = $_SESSION['passengerNames']; // This is now an array

  // Assuming you want to store passenger names as a comma-separated string
  $passengerNamesString = implode(',', $passengerNames);

  // File handling (assuming 'template_name' is the name attribute of the file input)
  $approvalFile = $_FILES["template_name"]["name"];
  $uploadDir = "../approval_file/"; // Specify the directory where you want to store uploaded files
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
  file_name, status) VALUES (:name, :department, :pass_name, :location, :bus,
  :date_departure, :time_departure, :exp_arrival, :time_arrival, :passengers, :purpose, :destination_name,
  :file_name, :status)");

  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':department', $department);
  $stmt->bindParam(':pass_name', $passengerNamesString);
  $stmt->bindParam(':location', $loc);
  $stmt->bindParam(':bus', $BusString);
  $stmt->bindParam(':date_departure', $DateDeparture);
  $stmt->bindParam(':time_departure', $TimeDeparture);
  $stmt->bindParam(':exp_arrival', $DateArrival);
  $stmt->bindParam(':time_arrival', $TimeReturn);
  $stmt->bindParam(':passengers', $Passengers);
  $stmt->bindParam(':purpose', $Purpose);
  $stmt->bindParam(':destination_name', $DestName);
  $stmt->bindParam(':file_name', $targetFile);
  $stmt->bindParam(':status', $status);
  
  // Execute the query
  $stmt->execute();

  // Redirect to a success page or do something else
  $message = "Reservation successful!";
  header("Location: car1.php");
  exit;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/sidebar.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <title>Document</title>
</head>
<body>
  <div class="main-wrapper">
		
    <?php
    include_once("./components/header.php");
    include_once("./components/sidebar.php");
    ?>

<div class="page-wrapper">
    
    <div class="content container-fluid">
    
        <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Trip Ticket</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Create Trip Ticket</li>
            </ul>
        </div>
        </div>
    </div>


        <section class="content">

        <div class="container-fluid">

        <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Create Trip Ticket</h3>

                    <div class="card-tools ">
                        <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#collapseContent" aria-expanded="true">
                        <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
            <div class="card-body">

            <div class="col-12">
                <h2>Form</h2>
                <form method="post" enctype="multipart/form-data" class="row g-3">
                    <!---Reservation Time-->
                <h5>Pick a Date and Time</h5>
                <div class="col-md-6">
                    <label for="date">Date of Trip:</label>
                    <input type="hidden" id="status" name="status" value="1" />
                    <input type="date" class="form-control" id="date_departure" name="date_departure" required>
                  </div>
                  <div class="col-md-6">
                    <label for="departureTime">Departure Time:</label>
                    <input type="time" class="form-control" id="time_departure" name="time_departure" required>
                  </div>
                  <div class="col-md-6">
                    <label for="returningDate">Returning Date:</label>
                    <input type="date" class="form-control" id="exp_arrival" name="exp_arrival" required>
                  </div>
                  <div class="col-md-6">
                    <label for="departureTime">Arrival Time:</label>
                    <input type="time" class="form-control" id="time_arrival" name="time_arrival" required>
                  </div><br><br><br><br><hr>

                  <div class="col-md-6">
                  <label for="inputState" class="form-label">Purpose</label>
                  <select id="purpose" name="purpose" class="form-select">
                      <option selected>Choose...</option>
                      <option>Test</option>
                      <option>Test1</option>
                      </select>
                  </div>
                <div class="col-md-6">
                    <label class="form-label">Destination name</label>
                    <input type="text" class="form-control" id="destination_name" name="destination_name">
                </div>
                  
                <br><br><br><br><hr>
                
                  <h5>Information</h5>
                  <div class="col-md-6">
                    <label class="form-label">Number of Passengers:</label>
                    <input type="number" class="form-control" id="passengers" name="passengers" min="1" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Department</label>
                    <select id="department" name="department" class="form-select">
                      <option selected>Choose...</option>
                      <option>Test</option>
                      <option>Test1</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <select id="location" name="location" class="form-select">
                      <option selected>Choose...</option>
                      <option>Within Batangas City</option>
                      <option>Outside Batangas City</option>
                      <option>Outside Lipa City</option>
                      <option>Inter Campus</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="bus_1" name="bus[]" id="bus_1">
                      <label class="form-check-label d-flex" for="bus_1">
                      Bus 1 -  <div id="availability_bus_1"></div>
                      </label>
                    
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_2" name="bus[]" id="bus_2">
                    <label class="form-check-label d-flex" for="bus_2">
                    Bus 2 - <div id="availability_bus_2"></div>
                    </label>
                    
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_3" name="bus[]" id="bus_3">
                    <label class="form-check-label d-flex" for="bus_3">
                    Bus 3 - <div id="availability_bus_3"></div>
                    </label>
                    
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_4" name="bus[]" id="bus_4">
                    <label class="form-check-label d-flex" for="bus_4">
                    Bus 4 - <div id="availability_bus_4"></div>
                    </label>
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_5" name="bus[]" id="bus_5">
                    <label class="form-check-label d-flex" for="bus_5">
                    Bus 5 - <div class="" id="availability_bus_5"></div>
                    </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="passengerNames">Passengers Names:</label>
                  <input type="text" class="form-control" id="passengerNames" name="passengerNames[]" placeholder="Enter name">
                  <button type="button" class="btn btn-primary" onclick="addPassenger()">Add Passenger</button>
                  <button type="button" class="btn btn-danger" onclick="deleteSelected()">Delete Selected</button>

                  <div class="mt-4">
                      <ul id="passengerList" name="passengerList[]" class="list-group">
                          <!-- Passenger names will be added here dynamically -->
                      </ul>
                  </div>
                </div>
                <div class="col-md-12">
                  <label>Approval File</label>
                  <input type="file" id="template_name" name="template_name"
                    class="form-control form-control-sm rounded-0" />
              </div>
                  <div class="col-12">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          
        </div>
    </div>
</div>
        </section>
    
        </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/jquery-3.2.1.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/popper.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/jquery.slimscroll.min.js"></script>
<script src="../style/morris/morris.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/nav.js"></script>

<script>
function addPassenger() {
    const passengerName = document.getElementById('passengerNames').value;

    if (passengerName.trim() !== '') {
        const passengerList = document.getElementById('passengerList');
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.innerHTML = `
            <input type="checkbox" class="form-check-input" name="selectedPassengers[]" value="${passengerName}">
            ${passengerName}
        `;
        passengerList.appendChild(listItem);
        document.getElementById('passengerNames').value = ''; // Clear the input field
    } else {
        alert('Please enter a passenger name.');
    }
}

function deleteSelected() {
    const checkboxes = document.getElementsByName('selectedPassengers');
    const passengerList = document.getElementById('passengerList');

    for (let i = checkboxes.length - 1; i >= 0; i--) {
        if (checkboxes[i].checked) {
            passengerList.removeChild(checkboxes[i].parentNode);
        }
    }
}
</script>
</body>
</html>