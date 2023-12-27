<?php
include "db_conn.php";
include 'session.php';


// Query to retrieve the first set of data
$query1 = "SELECT * FROM bus";
$result1 = mysqli_query($conn, $query1);

// Query to retrieve the second set of data
$query2 = "SELECT * FROM service2";
$result2 = mysqli_query($conn, $query2);

// Check if the queries were successful
if (!$result1 || !$result2) {
    echo "Query Failed!";
    exit();

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!doctype html>
    <html lang="en">
    
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.72.0">
      <title>Album example · Bootstrap</title>
    
      <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/">
    
    
    
      <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
      <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }
    
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
        
      </style>
    
    
    </head>
    <header>
      <?php 
      include 'components/header.php';
      ?>
    </header>
    <body>
    
      
    
      <main>
    
        <section class="py-5 text-center container">
          <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
              <h1 class="font-weight-light">Album example</h1>
              <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator,
                etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
              <p>
                <a href="#" class="btn btn-primary my-2">Main call to action</a>
                <a href="#" class="btn btn-secondary my-2">Secondary action</a>
              </p>
            </div>
          </div>
        </section>
    
        <div class="album py-5 bg-light">
          <div class="container">
    
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                      dy=".3em">Thumbnail</text>
                  </svg>
    
                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                      content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='car1/car1.php';"> Trip Ticket</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                 Trip Ticketed List
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel1"> Trip Ticketed List</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Total List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table id="all_patients"
                               class="table table-striped dataTable table-bordered dtr-inline"
                               role="grid" aria-describedby="all_patients_info">

                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Date of Trip</th>
                                <th>Departure Time</th>
                                <th>Returning Date</th>
                                <th>Arrival Time</th>
                            </tr>
                            </thead>

                            <tbody>
                              
                            <?php
                            $count = 0;
                            while ($row1 = mysqli_fetch_assoc($result1)){
                                $count++;
                                ?>
                                <tr>
                                    <td><?php echo $row1['location'];?></td>
                                    <td><?php echo $row1['date_departure'];?></td>
                                    <td><?php echo $row1['time_departure'];?></td>
                                    <td><?php echo $row1['exp_arrival'];?></td>
                                    <td><?php echo $row1['time_arrival'];?></td>

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
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                      dy=".3em">Thumbnail</text>
                  </svg>
    
                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                      content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='car2/car2.php';"> Trip Ticket</button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                 Trip Ticketed List
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel2"> Trip Ticketed List</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Total List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table id="all_patients"
                               class="table table-striped dataTable table-bordered dtr-inline"
                               role="grid" aria-describedby="all_patients_info">

                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Date of Trip</th>
                                <th>Departure Time</th>
                                <th>Returning Date</th>
                                <th>Arrival Time</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $count = 0;
                            while ($row2 = mysqli_fetch_assoc($result2)){
                                $count++;
                                ?>
                                <tr>
                                    <td><?php echo $row2['location'];?></td>
                                    <td><?php echo $row2['date_departure'];?></td>
                                    <td><?php echo $row2['time_departure'];?></td>
                                    <td><?php echo $row2['exp_arrival'];?></td>
                                    <td><?php echo $row2['time_arrival'];?></td>

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
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                      dy=".3em">Thumbnail</text>
                  </svg>
    
                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                      content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"> Trip Ticket</button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                                 Trip Ticketed List
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel3" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel3"> Trip Ticketed List</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Total List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table id="all_patients"
                               class="table table-striped dataTable table-bordered dtr-inline"
                               role="grid" aria-describedby="all_patients_info">

                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Service</th>
                                <th>Date of Trip</th>
                                <th>Departure Time</th>
                                <th>Returning Date</th>
                                <th>Arrival Time</th>
                                <th>Pax</th>
                                <th>Destination</th>
                            </tr>
                            </thead>

                            <tbody>
                              
                            
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->


        </section>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                      dy=".3em">Thumbnail</text>
                  </svg>
    
                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                      content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"> Trip Ticket</button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop4">
                                 Trip Ticketed List
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel4" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel4"> Trip Ticketed List</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Total List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table id="all_patients"
                               class="table table-striped dataTable table-bordered dtr-inline"
                               role="grid" aria-describedby="all_patients_info">

                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Service</th>
                                <th>Date of Trip</th>
                                <th>Departure Time</th>
                                <th>Returning Date</th>
                                <th>Arrival Time</th>
                                <th>Pax</th>
                                <th>Destination</th>
                            </tr>
                            </thead>

                            <tbody>
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->


        </section>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                      dy=".3em">Thumbnail</text>
                  </svg>
    
                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                      content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"> Trip Ticket</button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop5">
                                 Trip Ticketed List
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel5" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel5"> Trip Ticketed List</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Total List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table id="all_patients"
                               class="table table-striped dataTable table-bordered dtr-inline"
                               role="grid" aria-describedby="all_patients_info">

                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Service</th>
                                <th>Date of Trip</th>
                                <th>Departure Time</th>
                                <th>Returning Date</th>
                                <th>Arrival Time</th>
                                <th>Pax</th>
                                <th>Destination</th>
                            </tr>
                            </thead>

                            <tbody>
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->


        </section>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                      dy=".3em">Thumbnail</text>
                  </svg>
    
                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                      content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"> Trip Ticket</button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#6">
                                 Trip Ticketed List
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel6" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel6"> Trip Ticketed List</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Total List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table id="all_patients"
                               class="table table-striped dataTable table-bordered dtr-inline"
                               role="grid" aria-describedby="all_patients_info">

                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Service</th>
                                <th>Date of Trip</th>
                                <th>Departure Time</th>
                                <th>Returning Date</th>
                                <th>Arrival Time</th>
                                <th>Pax</th>
                                <th>Destination</th>
                            </tr>
                            </thead>

                            <tbody>
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->


        </section>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
                            

        <div class=" container-sm mb-5">
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
                                <!-- <th>No.</th> -->
                                <!-- <th>Date Filed</th> -->
                                <th>Department</th>
                                <th>Departure</th>
                                <th>Return</th>
                                <th>Purpose</th>
                                <th class="text-center">Status</th>
                                
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ublc_reservation";
                            
                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                            
                            if(!$conn){
                                die("Connection failed"). mysqli_connect_error();
                            }
                            $user = $_SESSION['name'];
                            
                            $sql = "SELECT * FROM `bus` WHERE userId = '$user' AND status = 1";
                            $result = mysqli_query($conn, $sql);
                            $count = 0;
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $dep = $row['department'];
                                    $departure = $row['date_departure'].' '. date('h:i a',strtotime($row['time_departure']));
                                    $arrival = $row['exp_arrival'].' '. date('h:i a',strtotime($row['time_arrival']));
                                    $purp = $row['purpose'];
                                    $_SESSION['rideReq'] = $count;
                                    echo "<tr>
                                    <td>$dep</td>
                                    <td>$departure</td>
                                    <td>$arrival</td>
                                    <td>$purp</td>
                                    <td><a href='pendingRequest.php?userId=$row[id]'><button id='statusCancel'  class='btn btn-outline-danger'>Cancel Trip</button></a></a><td>
                                    </tr>";
                                }
                            }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
      </main>
    
      <footer class="text-muted py-5">
        <div class="container">
          <p class="float-right mb-1">
            <a href="#">Back to top</a>
          </p>
          <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
          <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
              href="/docs/5.0/getting-started/introduction/">getting started guide</a>.</p>
        </div>
      </footer>

      <script src="style/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
      <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
          myInput.focus()
        })
      </script>
      
    
    </body>
    
    </html>
</body>
</html>