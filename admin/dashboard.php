<?php
include '../config/connection.php';
include '../session1.php';


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

$year =  date('Y');
$month =  date('m');

$queryToday = "SELECT count(*) as `today` 
  from `bus` 
  where `date_departure` = '$date';";

$queryWeek = "SELECT count(*) as `week` 
  from `bus` 
  where YEARWEEK(`date_departure`) = YEARWEEK('$date');";

$queryYear = "SELECT count(*) as `year` 
  from `bus` 
  where YEAR(`date_departure`) = YEAR('$date');";

$queryMonth = "SELECT count(*) as `month` 
  from `bus` 
  where YEAR(`date_departure`) = $year and 
  MONTH(`date_departure`) = $month;";

$todaysCount = 0;
$currentWeekCount = 0;
$currentMonthCount = 0;
$currentYearCount = 0;


try {

    $stmtToday = $con->prepare($queryToday);
    $stmtToday->execute();
    $r = $stmtToday->fetch(PDO::FETCH_ASSOC);
    $todaysCount = $r['today'];

    $stmtWeek = $con->prepare($queryWeek);
    $stmtWeek->execute();
    $r = $stmtWeek->fetch(PDO::FETCH_ASSOC);
    $currentWeekCount = $r['week'];

    $stmtYear = $con->prepare($queryYear);
    $stmtYear->execute();
    $r = $stmtYear->fetch(PDO::FETCH_ASSOC);
    $currentYearCount = $r['year'];

    $stmtMonth = $con->prepare($queryMonth);
    $stmtMonth->execute();
    $r = $stmtMonth->fetch(PDO::FETCH_ASSOC);
    $currentMonthCount = $r['month'];

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
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/bootstrap.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/sidebar.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/font-awesome.min.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/line-awesome.min.css">
  <link rel="stylesheet" href="../style/bootstrap-5.3.2-dist/css/select2.min.css">
  <link rel="stylesheet" href="../style/morris/morris.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <title>Document</title>
</head>
<body>
  <!-- Main Wrapper -->
  <div class="main-wrapper">
		
    <!-- Header -->
          <?php include_once("components/header.php");?>
    <!-- /Header -->
    
    <!-- Sidebar -->
          <?php include_once("components/sidebar.php");?>
    <!-- /Sidebar -->
    
    <!-- Page Wrapper -->
          <div class="page-wrapper">
    
      <!-- Page Content -->
              <div class="content container-fluid">
      
        <!-- Page Header -->
        <div class="page-header">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="page-title">Clients</h3>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Clients</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /Page Header -->
        <section class="content">
        <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $todaysCount;?></h3>

                                <p>Today's Ticket</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-calendar-day"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3><?php echo $currentWeekCount;?></h3>

                                <p>Current Week</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-calendar-week"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-fuchsia text-reset">
                            <div class="inner">
                                <h3><?php echo $currentMonthCount;?></h3>

                                <p>Current Month</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-calendar"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-maroon text-reset">
                            <div class="inner">
                                <h3><?php echo $currentYearCount;?></h3>

                                <p>Current Year</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-injured"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
      
          </div>
    <!-- /Page Wrapper -->
    
      </div>
  
      <script src="../style/bootstrap-5.3.2-dist/js/jquery-3.2.1.min.js"></script>
      <script src="../style/bootstrap-5.3.2-dist/js/popper.min.js"></script>
      <script src="../style/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
  <script src="../style/bootstrap-5.3.2-dist/js/jquery.slimscroll.min.js"></script>
  <script src="../style/morris/morris.min.js"></script>
  <script src="../style/bootstrap-5.3.2-dist/js/nav.js"></script>
  
</body>
</html>