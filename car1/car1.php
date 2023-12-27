<?php
include '../config/connection.php';

$message = '';
if(isset($_POST['submit'])) {
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

    //Selecting Bus
    $Selectedbus = isset($_POST['bus']) ? $_POST['bus'] : [];
    $busString = implode(", ", $Selectedbus);

    //Selecting passenger name
    $passengerNames = $_POST['passengerNames']; // This is now an array

    // Assuming you want to store passenger names as a comma-separated string
    $passengerNamesString = implode(',', $passengerNames);

    // File handling (assuming 'template_name' is the name attribute of the file input)
    $approvalFile = $_FILES["template_name"]["name"];
    $uploadDir = "../approval_file/"; // Specify the directory where you want to store uploaded files
    $targetFile = $uploadDir . basename($_FILES["template_name"]["name"]);

   // Move the uploaded file to the specified directory
    move_uploaded_file($_FILES["template_name"]["tmp_name"], $targetFile);
    
    $existingReservations = [];
    foreach ($Selectedbus as $bus) {
        $checkQuery = "SELECT COUNT(*) as count FROM bus2
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
    $stmt = $con->prepare("INSERT INTO bus2 (name, department, pass_name, location, bus,
    date_departure, time_departure, exp_arrival, time_arrival, passengers, purpose, destination_name,
    file_name) VALUES (:name, :department, :pass_name, :location, :bus,
    :date_departure, :time_departure, :exp_arrival, :time_arrival, :passengers, :purpose, :destination_name,
    :file_name)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':pass_name', $passengerNamesString);
    $stmt->bindParam(':location', $loc);
    $stmt->bindParam(':bus', $busString);
    $stmt->bindParam(':date_departure', $DateDeparture);
    $stmt->bindParam(':time_departure', $TimeDeparture);
    $stmt->bindParam(':exp_arrival', $DateArrival);
    $stmt->bindParam(':time_arrival', $TimeReturn);
    $stmt->bindParam(':passengers', $Passengers);
    $stmt->bindParam(':purpose', $Purpose);
    $stmt->bindParam(':destination_name', $DestName);
    $stmt->bindParam(':file_name', $targetFile);
    
    // Execute the query
    $stmt->execute();

    // Redirect to a success page or do something else
    $message = "Reservation successful!";
    header("Location: ../congratulation.php?goto_page=car1.php&message=$message");
    exit;
}
}

//  try {

//   $query = "SELECT `id`, `date_departure`,`exp_arrival`
//   FROM `bus` order by `id` asc;";
 

//   $stmtbus = $con->prepare($query);
//   $stmtbus->execute();
  

// } catch(PDOException $ex) {
//   echo $ex->getMessage();
//   echo $ex->getTraceAsString();
//   exit;
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <style>
        .forms-container {
          display: none;
        }
        .forms-container.active {
          display: block;
        }
      </style>
    <title>Document</title>
</head>

<body>
    <header>
        <?php
        include '../components/header.php';
        ?>
    </header>

    <div class="container">
        <div class="text-center">
            <img src="..." class="rounded" alt="...">
          </div>
          

          <div class="container-fluid">
           
              <div class="col-12">
                <h2>Form</h2>
                <form method="post" enctype="multipart/form-data" class="row g-3">
                    <!---Reservation Time-->
                <h5>Pick a Date and Time</h5>
                <div class="col-md-6">
                    <label for="date">Date of Trip:</label>
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
                  </div>
                  <div class="col-md-6">
                    <label for="passengers">Number of Passengers:</label>
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
                      bus 1 -  <div id="availability_bus_1"></div>
                      </label>
                    
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_2" name="bus[]">
                    <label class="form-check-label d-flex" for="bus_2">
                    bus 2 - <div id="availability_bus_2"></div>
                    </label>
                    
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_3" name="bus[]">
                    <label class="form-check-label d-flex" for="bus_3">
                    bus 3 - <div id="availability_bus_3"></div>
                    </label>
                    
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_4" name="bus[]">
                    <label class="form-check-label d-flex" for="bus_4">
                    bus 4 - <div id="availability_bus_4"></div>
                    </label>
                    </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_5" name="bus[]">
                    <label class="form-check-label d-flex" for="bus_5">
                    bus 5 - <div class="" id="availability_bus_5"></div>
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
                
                
                  <h5>Information</h5>
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
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

function updatebusAvailability(busNumber) {
        // Get selected date and time
        const dateDeparture = document.getElementById('date_departure').value;
        const timeDeparture = document.getElementById('time_departure').value;
        const dateArrival = document.getElementById('exp_arrival').value;
        const timeArrival = document.getElementById('time_arrival').value;

        // Make an AJAX request to check bus availability
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    // Update the availability status on the page
                    const availabilityDiv = document.getElementById(`availability_${busNumber}`);
                    availabilityDiv.innerHTML = response.available ? 'Available' : 'Unavailable';
                }
            }
        };

        // Send the request
        xhr.open('GET', `check_availability.php?bus=${busNumber}&date_departure=${dateDeparture}&time_departure=${timeDeparture}&exp_arrival=${dateArrival}&time_arrival=${timeArrival}`, true);
        xhr.send(); 
    }

    // Attach event listeners to update availability on date and time change
    document.getElementById('date_departure').addEventListener('change', function () {
        updatebusAvailability('bus_1');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_departure').addEventListener('change', function () {
        updatebusAvailability('bus_1');
        // Repeat similar lines for other buses
    });

    document.getElementById('exp_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_1');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_1');
        // Repeat similar lines for other buses
    });

    // Initial availability check on page load
    window.addEventListener('load', function () {
        updatebusAvailability('bus_1');
        // Repeat similar lines for other buses
    });

    document.getElementById('date_departure').addEventListener('change', function () {
        updatebusAvailability('bus_2');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_departure').addEventListener('change', function () {
        updatebusAvailability('bus_2');
        // Repeat similar lines for other buses
    });

    document.getElementById('exp_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_2');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_2');
        // Repeat similar lines for other buses
    });

    // Initial availability check on page load
    window.addEventListener('load', function () {
        updatebusAvailability('bus_2');
        // Repeat similar lines for other buses
    });
    document.getElementById('date_departure').addEventListener('change', function () {
        updatebusAvailability('bus_3');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_departure').addEventListener('change', function () {
        updatebusAvailability('bus_3');
        // Repeat similar lines for other buses
    });

    document.getElementById('exp_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_3');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_3');
        // Repeat similar lines for other buses
    });

    // Initial availability check on page load
    window.addEventListener('load', function () {
        updatebusAvailability('bus_3');
        // Repeat similar lines for other buses
    });

    document.getElementById('date_departure').addEventListener('change', function () {
        updatebusAvailability('bus_4');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_departure').addEventListener('change', function () {
        updatebusAvailability('bus_4');
        // Repeat similar lines for other buses
    });

    document.getElementById('exp_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_4');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_4');
        // Repeat similar lines for other buses
    });

    // Initial availability check on page load
    window.addEventListener('load', function () {
        updatebusAvailability('bus_4');
        // Repeat similar lines for other buses
    });

    document.getElementById('date_departure').addEventListener('change', function () {
        updatebusAvailability('bus_5');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_departure').addEventListener('change', function () {
        updatebusAvailability('bus_5');
        // Repeat similar lines for other buses
    });

    document.getElementById('exp_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_5');
        // Repeat similar lines for other buses
    });

    document.getElementById('time_arrival').addEventListener('change', function () {
        updatebusAvailability('bus_5');
        // Repeat similar lines for other buses
    });

    // Initial availability check on page load
    window.addEventListener('load', function () {
        updatebusAvailability('bus_5');
        // Repeat similar lines for other buses
    });

    function attachbusListeners(busNumber) {
    document.getElementById('date_departure').addEventListener('change', function () {
        updatebusAvailability(busNumber);
    });

    // Repeat for other events and buses
}

// Attach listeners for each bus
attachbusListeners('bus_1');
attachbusListeners('bus_2');
// Repeat for other buses
</script>

</body>
</html>