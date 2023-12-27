<?php
include '../config/connection.php';
include '../session1.php';

try {

    $query = "SELECT * FROM `bus` WHERE STATUS = 0";

    $stmtPatient1 = $con->prepare($query);
    $stmtPatient1->execute();

} catch(PDOException $ex) {
    echo $ex->getMessage();
    echo $ex->getTraceAsString();
    exit;
}

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
            <h3 class="page-title">Cancelled Ticket</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Cancelled Ticket</li>
            </ul>
        </div>
        </div>
    </div>
        <!-- /Page Header -->
        <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Total Cancelled Tickets</h3>

                    <div class="card-tools ">
                        <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#collapseContent" aria-expanded="true">
                        <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Search Bar -->
                        <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                    <div class="row table-responsive">
                        <table id="all_patients"
                            class="table table-striped dataTable table-bordered dtr-inline"
                            role="grid" aria-describedby="all_patients_info" id="myTable">

                            <thead>
                            <tr>
                                <th>No.</th>
                                <!-- <th>Date Filed</th> -->
                                <th>Department</th>
                                <th>Departure</th>
                                <th>Return</th>
                                <th>Purpose</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $count = 0;
                            while($row =$stmtPatient1->fetch(PDO::FETCH_ASSOC)){
                                $count++;
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <!-- <td><?php //echo $row['date_filed'];?></td> -->
                                    <td><?php echo $row['department'];?></td>
                                    <td><?php echo $row['date_departure'].' '. date('h:i a',strtotime($row['time_departure']));?></td>
                                    <td><?php echo $row['exp_arrival'].' '. date('h:i a',strtotime($row['time_arrival']));?></td>
                                    <td><?php echo $row['purpose'];?></td>

                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->


        </section>
    
        </div>
    <!-- /Page Wrapper -->
    
      </div>
  <!-- /Main Wrapper -->
  
  <!-- jQuery -->
      <script src="../style/bootstrap-5.3.2-dist/js/jquery-3.2.1.min.js"></script>
  
  <!-- Bootstrap Core JS -->
      <script src="../style/bootstrap-5.3.2-dist/js/popper.min.js"></script>
      <script src="../style/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
  
  <!-- Slimscroll JS -->
  <script src="../style/bootstrap-5.3.2-dist/js/jquery.slimscroll.min.js"></script>
  
  <!-- Select2 JS -->
  <script src="../style/morris/morris.min.js"></script>
  
  <!-- Custom JS -->
  <script src="../style/bootstrap-5.3.2-dist/js/nav.js"></script>
  
<script>
    // JavaScript for Table Search
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