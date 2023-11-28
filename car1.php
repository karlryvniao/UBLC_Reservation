<?php
include './config/connection.php';


$message = '';
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    //$passengerName = explode(",", $_POST['pass_name']);
    $loc = $_POST['location'];
    $DateDeparture = $_POST['date_departure'];
    $TimeDeparture = $_POST['time_departure'];
    $DateArrival = $_POST['exp_arrival'];
    $DateReturn = $_POST['time_arrival'];
    $Passengers = $_POST['passengers'];
    $Purpose = $_POST['purpose'];
    $DestName = $_POST['destination_name'];

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
    
   $availabilityCheck = $con->prepare("SELECT COUNT(*) FROM bus WHERE date_departure = :date_departure AND time_departure = :time_departure AND exp_arrival = :exp_arrival AND time_arrival = :time_arrival");
   $availabilityCheck->bindParam(':date_departure', $DateDeparture);
   $availabilityCheck->bindParam(':time_departure', $TimeDeparture);
   $availabilityCheck->bindParam(':exp_arrival', $exp_arrival);
   $availabilityCheck->bindParam(':time_arrival', $time_arrival);
   $availabilityCheck->execute();
   $existingReservations = $availabilityCheck->fetchColumn();

   if ($existingReservations > 0) {
       $message = 'Sorry, the selected date and time are already reserved. Please choose a different date and time.';
   } else {


    $stmt = $con->prepare("INSERT INTO bus (name, department, pass_name, location, bus,
    date_departure, time_departure, exp_arrival, time_arrival, passengers, purpose, destination_name,
    file_name) VALUES (:name, :department, :pass_name, :location, :bus,
    :date_departure, :time_departure, :exp_arrival, :time_arrival, :passengers, :purpose, :destination_name,
    :file_name)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':pass_name', $passengerNamesString);
    $stmt->bindParam(':location', $loc);
    $stmt->bindParam(':bus', $BusesString);
    $stmt->bindParam(':date_departure', $DateDeparture);
    $stmt->bindParam(':time_departure', $TimeDeparture);
    $stmt->bindParam(':exp_arrival', $DateArrival);
    $stmt->bindParam(':time_arrival', $DateReturn);
    $stmt->bindParam(':passengers', $Passengers);
    $stmt->bindParam(':purpose', $Purpose);
    $stmt->bindParam(':destination_name', $DestName);
    $stmt->bindParam(':file_name', $targetFile);
    
    // Execute the query
    $stmt->execute();

    // Redirect to a success page or do something else
    header("Location:congratulation.php?goto_page=car1.php&message=$message");
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
    <link rel="stylesheet" href="style/bootstrap-5.3.2-dist/css/bootstrap.min.css">
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
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-white">About</h4>
                <p class="text-muted">Add some information about the album below, the author, or any other background
                context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off
                to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
                <h4 class="text-white">Contact</h4>
                <ul class="list-unstyled">
                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                <li><a href="#" class="text-white">Like on Facebook</a></li>
                <li><a href="#" class="text-white">Email me</a></li>
                </ul>
            </div>
            </div>
        </div>x
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2"
                viewBox="0 0 24 24">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                <circle cx="12" cy="13" r="4" /></svg>
            <strong>Album</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
            aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        </div>
    </header>

    <div class="container">
        <div class="text-center">
            <img src="..." class="rounded" alt="...">
          </div>
          

          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="btn-group mt-3">
                  <button type="button" class="btn btn-primary" onclick="showForm('form1')">Within Batangas City</button>
                  <button type="button" class="btn btn-primary" onclick="showForm('form2')">Outside Batangas City</button>
                  <button type="button" class="btn btn-primary" onclick="showForm('form3')">Outside Lipa City</button>
                  <button type="button" class="btn btn-primary" onclick="showForm('form4')">Inter Campus</button>
                </div>
              </div>
            </div>
            
            <div class="row forms-container" id="form1">
              <div class="col-12">
                <h2>Form 1</h2>
                <form method="post" enctype="multipart/form-data" class="row g-3">
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
                    <input class="form-check-input" type="checkbox" value="bus_1" name="bus[]">
                    <label class="form-check-label" for="flexCheckDefault">
                      BUS 1
                    </label>
                  </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_2" name="bus[]">
                    <label class="form-check-label" for="flexCheckDefault">
                      BUS 2
                    </label>
                  </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_3" name="bus[]">
                    <label class="form-check-label" for="flexCheckDefault">
                      BUS 3
                    </label>
                  </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_4" name="bus[]">
                    <label class="form-check-label" for="flexCheckDefault">
                      BUS 4
                    </label>
                  </div><div class="form-check">
                    <input class="form-check-input" type="checkbox" value="bus_5" name="bus[]">
                    <label class="form-check-label" for="flexCheckDefault">
                      BUS 5
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
                
                <!---Reservation Time-->
                <h5>Reservation Time</h5>
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
          
            <!-- <div class="row forms-container" id="form2">
              <div class="col-12">
                <h2>Form 2</h2>
                <form class="row g-3">
              
                  <div class="col-12">
                    <label for="inputAddress" class="form-label"></label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                  </div>
                  <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                  </div>
                  <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                  </div>
                  <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                      <option selected>Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck">
                      <label class="form-check-label" for="gridCheck">
                        Check me out
                      </label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div> -->
          </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
<script>
  function showForm(formId) {
    // Hide all forms
    $(".forms-container").removeClass("active");
    // Show the selected form
    $("#" + formId).addClass("active");
  }

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