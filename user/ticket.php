<?php
session_start();
include '../session1.php';
$user = $_SESSION['id'];



$ublc_department_sql = "SELECT * FROM ublc_department";
$ublc_department_result = $conn->query($ublc_department_sql);

$location_area_types_sql = "SELECT * FROM location_area_types";
$location_area_types_result = $conn->query($location_area_types_sql);

$vehicle_sql = "SELECT * FROM vehicle";
$vehicle_result = $conn->query($vehicle_sql);

$errors = [];


if(isset($_POST['submit'])) {
  if ($other_department == '' && $location == ''){
    $insert_sql = "INSERT INTO user_reservation_vehicle(user_id, title, departure, arrival, purpose_description, no_passengers, department_id, other_department, location_area, location)
      VALUES (
       ?, ?, ? , ? , ?, ?, ?, NULL, ?, NULL
      )";
  }

  elseif($other_department == ''){
    $insert_sql = "INSERT INTO user_reservation_vehicle(user_id, title, departure, arrival, purpose_description, no_passengers, department_id, other_department, location_area, location)
      VALUES (
       ?, ?, ? , ? , ?, ?, ?, NULL, ?, ?
      )";
  }

  elseif($location == ''){
    $insert_sql = "INSERT INTO user_reservation_vehicle(user_id, title ,departure, arrival, purpose_description, no_passengers, department_id, other_department, location_area, location)
      VALUES (
       ?, ? , ? , ? , ?, ?, ?, ? , ?, NULL
      )";
  }
  try{
      $conn->begin_transaction(); 
      $stmt = $conn->prepare($insert_sql);
      if ($other_department == '' && $location == ''){
        $stmt->bind_param("issssiii", $user, $title , $departure_datetime, $arrival_datetime, $purpose, $no_passengers, $department_id, $location_area_type);
      }


      elseif($location == ''){
        $stmt->bind_param("issssiiis", $user, $title , $departure_datetime, $arrival_datetime, $purpose, $no_passengers, $department_id, $location_area_type, $location);
      }
      elseif($other_department == ''){
        $stmt->bind_param("issssiisi", $user, $title , $departure_datetime, $arrival_datetime, $purpose, $no_passengers, $department_id, $other_department ,$location_area_type);
      }
      $title = $_POST['title'];
      $date_departure = $_POST['date_departure'];
      $time_departure = $_POST['time_departure'];
      $date_arrival = $_POST['date_arrival'];
      $time_arrival = $_POST['time_arrival'];
      $purpose = $_POST['purpose'];
      $no_passengers = $_POST['no-passengers'];
      $department_id = $_POST['department'];
      $other_department = $_POST['other-department'] ?? '' ;
      $location_area_type = $_POST['location-area-type'];
      $location = $_POST['location'] ?? '' ; //When outside batangas
      $vehicles = $_POST['vehicle'];
      // $destination_name = $_POST['destination_name'];
      
      if($title == ''){
        $errors['title'] = 'Please provide a title of travel';
      }
      if($date_departure == ''){
        $errors['date_departure'] = 'Please provide a date of departure.';
      }
      if($time_departure == ''){
        $errors['time_departure'] = 'Please provide a time of departure.';
      }
      if($date_arrival == ''){
        $errors['date_arrival'] = 'Please provide a date of arrival.';
      }
      if($time_arrival == ''){
        $errors['time_arrival'] = 'Please provide a time of arrival.';
      }
      if($purpose == ''){
        $errors['purpose'] = 'Please provide a purpose of travel.';
      }
      if($no_passengers == '' or $no_passengers <= 1){
        $errors['no-passengers'] = 'Please provide the number of passengers. Minimum 1';
      }
      if($department_id == ''){
        $errors['department'] = 'Please select a department';
      }
      //Also check if the user choose the others choice.
      if(empty($vehicles)){
        $errors['vehicles'] = 'Please choose atleast one vehicle';
      }

      // $sql = "SELECT A.id FROM vehicle as A WHERE A.id NOT IN(SELECT DISTINCT B.vehicle_id FROM user_reservation_vehicle as A
      // JOIN  reserved_vehicles as B ON B.reservation_id = A.id
      // WHERE A.departure <= '$arrival_datetime' AND A.arrival >= '$departure_datetime')";

      // $sql_result = $conn->query($sql);
      // $query_result = $sql_result->fetch_all(MYSQLI_ASSOC);

      
      if(!empty($errors)){
        throw new Exception("The form is invalid. Please check the fields if correct.");
      }
      
      $departure_datetime = join(" ",[$date_departure, $time_departure .":00"]);
      $arrival_datetime = join(" ",[$date_arrival, $time_arrival . ":00"]);

      $stmt->execute();

      $reservation_id = $conn->insert_id;

      $vehicle_reserved_stmt = $conn->prepare(
      "INSERT INTO reserved_vehicles(reservation_id, vehicle_id)
      VALUES (?,?)");
    foreach( $vehicles as $vehicle_id){
      $vehicle_reserved_stmt->bind_param("ii", $reservation_id, $vehicle_id);
      $vehicle_reserved_stmt->execute();
    }
    

    $conn->commit(); 
  }catch(mysqli_sql_exception $exception) { 
    $conn->rollback(); 
    $message = "An error occured. Failed to make the reservation";
    print_r($exception);
  }
  catch (Exception $e){
    $message = $e->getMessage();
  }
  // Redirect to a success page or do something else
  // $message = "Reservation successful!";
  // header("Location: car1.php");
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
                <form method="post" enctype="multipart/form-data" class="row g-3">
                    <!---Reservation Time-->
                <h5>Pick a Date and Time</h5>
                <div class="col-md-6 form-group">
                  <label for="date">Date of Trip:</label>
                  <input type="date" class="form-control" id="date_departure" name="date_departure" >
                  <?php if(isset($errors['date_departure'])) : ?>
                    <span class="help-block text-danger">
                    <?= $errors['date_departure'] ?>
                    </span>
                  <?php endif?>
                  </div>
                  <div class="col-md-6">
                    <label for="departureTime">Departure Time:</label>
                    <input type="time" class="form-control" id="time_departure" name="time_departure" >
                    <?php if(isset($errors['time_departure'])) : ?>
                      <span class="help-block text-danger">
                      <?= $errors['time_departure'] ?>
                      </span>
                    <?php endif?>
                  </div>
                  <div class="col-md-6">
                    <label for="returningDate">Returning Date:</label>
                    <input type="date" class="form-control" id="date_arrival" name="date_arrival" >
                    <?php if(isset($errors['date_arrival'])) : ?>
                      <span class="help-block text-danger">
                        <?= $errors['date_arrival'] ?>
                      </span>
                    <?php endif?>
                  </div>
                  <div class="col-md-6">
                    <label for="departureTime">Arrival Time:</label>
                    <input type="time" class="form-control" id="time_arrival" name="time_arrival" >
                    <?php if(isset($errors['time_arrival'])) : ?>
                      <span class="help-block text-danger">
                      <?= $errors['time_arrival'] ?>
                    </span>
                  <?php endif?>
                  
                  </div>
                  <div class="col-md-6 form-group">
                    <label>
                      Title
                    </label>
                    <input type="text" name="title" class="form-control">
                    <?php if(isset($errors['title'])) : ?>
                      <span class="help-block text-danger">
                      <?= $errors['title'] ?>
                    </span>
                    <?php endif?>
                  </div>
                  <br><br><br><br><hr>

                <div class="col-md-6 form-group">
                  <label for="inputState" class="form-label">Travel Purpose</label>
                  <textarea 
                    class="form-control" 
                    id="purpose-id" 
                    name="purpose" 
                    rows="3"
                    placeholder="Description here..."
                  ></textarea>
                  <?php if(isset($errors['purpose'])) : ?>
                      <span class="help-block text-danger">
                      <?= $errors['purpose'] ?>
                    </span>
                  <?php endif?>
                </div>

                <!-- <div class="col-md-6">
                    <label class="form-label">Destination name</label>
                    <input type="text" class="form-control" id="destination_name" name="destination_name">
                </div>
                   -->
                <br><br><br><br><hr>
                
                  <h5>Information</h5>
                  <div class="col-md-6">
                    <label class="form-label">Number of Passengers:</label>
                    <input type="number" class="form-control" id="no-passengers-id" name="no-passengers" min="1" >
                    <?php if(isset($errors['no-passengers'])) : ?>
                      <span class="help-block text-danger">
                      <?= $errors['no-passengers'] ?>
                    </span>
                  <?php endif?>
                  
                  </div>
                  <!-- <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div> -->
                  <div class="col-md-6">
                    <label class="form-label">Department</label>
                    <select id="department-id" name="department" class="form-select">
                      <?php while ($row = $ublc_department_result->fetch_assoc()):?>
                        <option value="<?=$row['id']?>"><?=ucwords($row["name"])?></option>
                      <?php endwhile ?>
                    </select>
                    <?php if(isset($errors['department'])) : ?>
                      <span class="help-block text-danger">
                      <?= $errors['department'] ?>
                    </span>
                  <?php endif?>
                  </div>

                  <div class="col-md-6 form-group d-none">
                    <label class="form-label">Other Department</label>
                    <input class="form-control" id="other-department-id" name="other-department"/>
                  </div>

                  <div class="col-md-6 form-group">
                    <label class="form-label">Location Area Type</label>
                    <select id="location-area-type-id" name="location-area-type" class="form-select">
                      <?php while($row_ = $location_area_types_result->fetch_assoc()): ?>
                      <option value="<?= $row_["id"]?>">
                        <?= ucwords($row_["label"]) ?>
                      </option>
                      <?php endwhile?>
                    </select>
                  </div>
                  <div class="col-md-6 form-group d-none">
                    <label class="form-label">Location</label>
                    <input class="form-control" id="location-id" name="location"/>
                  </div>
                  <div class="col-md-6 form-group">
                    <p>Available Vehicles: </p>
                    <div id="vehicle-choices" class="">
                      <p>Please select a departure and arrival date time</p>
                    </div>
                    <?php if(isset($errors['vehicles'])) : ?>
                      <span class="help-block text-danger">
                      <?= $errors['vehicles'] ?>
                    </span>
                  <?php endif?>
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
<script>
  //Other option node in Department select box
  $("#department-id").on("change", function(){
    const selected = $(this).find(":selected").text();
    if(selected.toLowerCase() === "others"){
      $("#other-department-id").parent().removeClass('d-none');
    }else{
      $("#other-department-id").parent().addClass('d-none');
    }
  });
  $("#location-area-type-id").on("change", function(){
    const selected = $(this).find(":selected").text();
    if(/outside batangas city/i.test(selected)){
      $("#location-id").parent().removeClass('d-none');
    }else{
      $("#location-id").parent().addClass('d-none');
    }
  });
</script>
<script>

  const dateTimeSchedule = {
    departure: {
      date: '',
      time: ''
    },
    arrival: {
      date:'',
      time:''
    },
    missing : [
      'departure.date',
      'departure.time',
      'arrival.date',
      'arrival.time'
    ],
    checkComplete: function(){
      return this.missing.length < 1
    },
    add: function(type, key, value){
      this[type][key]= value;
      this.missing = this.missing.filter((missingTypekey) => {
        const typeKey = [type, key].join('.')
        return missingTypekey !== typeKey
      })
      if (this.checkComplete()){
        this.fetchVehicles()
        return
      }
    },
    fetchVehicles: function(){
      if (!this.checkComplete()){
        return
      }
      const endpoint = `ajax/vehicles.php?departure_date=${encodeURIComponent(this.departure.date)}&departure_time=${encodeURIComponent(this.departure.time)}&arrival_date=${encodeURIComponent(this.arrival.date)}&arrival_time=${encodeURIComponent(this.arrival.time)}`;

      fetch(endpoint,{
        method:"GET"
      })
      .then((response) => {
        if (!response.ok){
          throw Error
        }
        return response.json()
      })
      .then((data)=> {
        const {
          available_vehicles
        } = data;
        const vehicleDiv = $("#vehicle-choices");
        vehicleDiv.empty();
        vehicleDiv.html(
          available_vehicles.map(({id, name, max_capacity})=>{
            return `
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="${id}" name="vehicle[]" for="vehicle-<?= $row['id'] ?>">
              <label class="form-check-label d-flex" for="vehicle-${id}">
                ${name}
                <div class="px-1" id="availability_bus_1">Max Capacity:${max_capacity}</div>
              </label>
            </div>
            `
          }).join(' ')
        )
      }).catch((e) => {
        alert("An error occured. When fetching available vehicles.")
      })
    }
  }
  $("#date_departure").on("change", function(){
    dateTimeSchedule.add("departure","date",$(this).val())
  });
  $("#time_departure").on("change", function(){
    dateTimeSchedule.add("departure","time",$(this).val())
  });
  $("#date_arrival").on("change", function(){
    dateTimeSchedule.add("arrival","date",$(this).val())
  });
  $("#time_arrival").on("change", function(){
    dateTimeSchedule.add("arrival","time",$(this).val())
  });
</script>
</body>
</html>