<?php
session_start();
include '../session1.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/sidebar.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/font-awesome.min.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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
                <li class="breadcrumb-item active">Trip Ticket Request</li>
            </ul>
        </div>
        </div>
    </div>
        <section class="content">
        <div class="container-fluid">
           
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
        </section>
    
        </div>

<script src="../style/bootstrap-5.3.2-dist/js/jquery-3.2.1.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/popper.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/jquery.slimscroll.min.js"></script>
<script src="../style/morris/morris.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/nav.js"></script>

<script>
$(document).ready(function(){
    $("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
});

$(function () {
            $("#all_patients").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#all_patients_wrapper .col-md-6:eq(0)');

        });



 // Use jQuery to handle form submission
$(document).ready(function() {
    $('#statusForm').submit(function(e) {
      e.preventDefault(); // Prevent the default form submission
    
      // Get the selected status value
    var selectedStatus = $('#statusDropdown').val();
    
      // Send the selected status to the server using AJAX
    $.ajax({
        type: 'POST',
        url: 'process_status.php', // Replace with your PHP script URL
        data: { status: selectedStatus },
        success: function(response) {
        alert('Status successfully submitted: ' + response);
          // You can perform additional actions here based on the server response
        },
        error: function(error) {
        alert('Error submitting status: ' + error);
        }
    });
    });
});

$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>