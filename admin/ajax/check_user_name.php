<?php 
	include '../../config/connection.php';

  	$userName = $_GET['user_name'];

  $query = "SELECT count(*) as `count` 
from `users` 
where `username` = '$userName';";
  $stmt = $con->prepare($query);
  $stmt->execute();

	$r = $stmt->fetch(PDO::FETCH_ASSOC);
  $count = $r['count'];

  echo $count;

?>