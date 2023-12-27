
<?php 
// this code is for redirecting to different pages if the credentials are correct.
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
         //admin
      	if ($_SESSION['role'] == 'admin'){
			header("Location: admin/dashboard.php");
      	 }
		 //teacher
		 else if ($_SESSION['role'] == 'user'){
			header("Location: home.php");
      	}
 }
else{
	header("Location:index.php");
} ?>
