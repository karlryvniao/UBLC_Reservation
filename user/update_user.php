<?php

include '../config/connection.php';

if (isset($_POST['update_user'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password']; // You may want to hash the password for security
    $role = $_POST['role'];

    // Assuming you have a users table with columns: id, name, username, password, role
    $sql = "UPDATE users SET name = :name, username = :username, password = :password, role = :role WHERE id = :user_id";

    // You need to replace :user_id with the actual user ID you want to update
    // If you're using sessions, you may have stored the user ID there ($_SESSION['user_id'])
    
    try {
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role); // Replace $user_id with the actual user ID
        $stmt->execute();

        echo "User information updated successfully";
    } catch (PDOException $e) {
        echo "Error updating user information: " . $e->getMessage();
    }
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        <!-- /Page Header -->
        <section class="content">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Users</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-outline card-primary rounded-0 shadow">
          <div class="card-header">
            <h3 class="card-title">Update User</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>

            </div>
          </div>
          <div class="card-body">
            <form method="post" id="updateForm" enctype="multipart/form-data">
              <input type="hidden" name="hidden_id"
               value="<?php echo $user_id;?>">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                  <label>Display Name</label>
                  <input type="text" id="name" name="name" required="required"
                  class="form-control form-control-sm rounded-0" value="<?php echo $row['name'];?>" />
                </div>
                <br>
                <br>
                <br>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                  <label>Username</label>
                  <input type="text" id="username" name="username" required="required"
                  class="form-control form-control-sm rounded-0" value="<?php echo $row['username'];?>" />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                  <label>Password</label>
                  <input type="password" id="password" name="password"
                  class="form-control form-control-sm rounded-0"/>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                    <label>Role</label>
                    <select class="form-select" aria-label="Default select example" id="role" name="role">
                    <option selected>Select Role</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                    </select>

                </div>

              </div>
              

            <div class="clearfix">&nbsp;</div>
            <div class="row">
              <div class="col-lg-11 col-md-10 col-sm-10">&nbsp;</div>
              <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                <button type="submit" id="update_user"
                name="update_user" class="btn btn-primary btn-sm btn-flat btn-block">Update</button>
              </div>
            </div>
          </form>
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


<script>
  $(document).ready(function() {
  $("#update_user").on("click", function() {
    // Serialize form data to JSON
    var formData = $("#updateForm").serializeArray();
    var jsonData = {};
    $.each(formData, function() {
      jsonData[this.name] = this.value;
    });

    // AJAX request to update data
    $.ajax({
      type: "POST",
      url: "updateUser.php", // Specify your PHP file handling the update
      data: { data: JSON.stringify(jsonData) },
      success: function(response) {
        // Handle success response
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(xhr.responseText);
      }
    });
  });
});
</script>
</body>
</html>