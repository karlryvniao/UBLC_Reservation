<?php

include "db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
}else{
	header("Location: ../index.php");
}
?>