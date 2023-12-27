<?php

include '../config/connection.php';

$message = '';

if(isset($_POST['save_user'])) {
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Insert user information into the database
    $stmt = $con->prepare("INSERT INTO users (username, password, name, role) VALUES (:username, :password, :name, :role)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':role', $role);

    try {
        $stmt->execute();
        echo "User information inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }



header("location:congratulation.php?goto_page=users.php&message=$message");
exit;
}



$queryUsers = "SELECT `id`, `username`, `name`,
`role` FROM `users`
ORDER BY `name` ASC;";
$stmtUsers = '';

try {
    $stmtUsers = $con->prepare($queryUsers);
    $stmtUsers->execute();

} catch(PDOException $ex) {
      echo $ex->getTraceAsString();
      echo $ex->getMessage();
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
        <div class="card card-outline card-primary rounded-0 shadow">
          <div class="card-header">
            <h3 class="card-title">Add User</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
             <div class="row">

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Display Name</label>
                <input type="text" id="name" name="name" required="required"
                class="form-control form-control-sm rounded-0" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Username</label>
                <input type="text" id="username" name="username" required="required"
                class="form-control form-control-sm rounded-0" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Password</label>
                <input type="password" id="password"
                name="password" required="required"
                class="form-control form-control-sm rounded-0" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Role</label>
                <select class="form-select" aria-label="Default select example" id="role" name="role">
                <option selected>Select Role</option>
                <option value="user">user</option>
                <option value="admin">admin</option>
                </select>
              </div>

              <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 mt-4">
                <label>&nbsp;</label>
                <button type="submit"
                name="save_user" class="btn btn-primary btn-sm btn-flat btn-block">Save</button>
              </div>
            </div>
          </form>
        </div>

      </div>
        </section>

        <section class="content">
      <!-- Default box -->
      
      <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
          <h3 class="card-title">All Users</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body">
         <div class="row table-responsive">

          <table id="all_users" 
          class="table table-striped dataTable table-bordered dtr-inline" 
          role="grid" aria-describedby="all_users_info">
          <colgroup>
            <col width="5%">
            <col width="10%">
            <col width="50%">
            <col width="25%">
            <col width="10%">
          </colgroup>
          <thead>
            <tr>
             <th class="p-1 text-center">S.No</th>
             <th class="p-1 text-center">Display Name</th>
             <th class="p-1 text-center">Username</th>
             <th class="p-1 text-center">Role</th>
             <th class="p-1 text-center">Action</th>
           </tr>
         </thead>

         <tbody>
          <?php 
          $serial = 0;
          while($row = $stmtUsers->fetch(PDO::FETCH_ASSOC)) {
           $serial++;
           ?>
           <tr>
             <td class="px-2 py-1 align-middle text-center"><?php echo $serial;?></td>
             
            <td class="px-2 py-1 align-middle text-center"><?php echo $row['name'];?></td>
            <td class="px-2 py-1 align-middle text-center"><?php echo $row['username'];?></td>
            <td class="px-2 py-1 align-middle text-center"><?php echo $row['role'];?></td>
            <td class="px-2 py-1 align-middle text-center">
                <a href="update_user.php?user_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm btn-flat">
                <i class="fa fa-edit"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#form_delete<?php echo $row['id']?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
              </td>
              <!-- Modal -->
              <div class="modal fade" id="form_delete<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete template</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <?php echo $row['display_name']?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form method="POST" action="remove_user.php">
                                                    <input type="hidden" name="form_id" value="<?php echo $row['id']?>"/>
                                                    <input type="hidden" name="form_profile_picture" value="<?php echo $row['profile_picture']?>"/>
                                                    <input type="hidden" name="form_user_name" value="<?php echo $row['user_name']?>"/>
                                                    <button type="submit" class="btn btn-danger" name="form_remove">Continue</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
         </tr>
       <?php } ?>
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
<script src="../style/bootstrap-5.3.2-dist/js/jquery-3.2.1.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/popper.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/jquery.slimscroll.min.js"></script>
<script src="../style/morris/morris.min.js"></script>
<script src="../style/bootstrap-5.3.2-dist/js/nav.js"></script>

<script>
var message = '<?php echo $message;?>';

if(message !== '') {
  showCustomMessage(message);
}


$(document).ready(function() {

  $("#user_name").blur(function() {
    var userName = $(this).val().trim();
    $(this).val(userName);

    if(userName !== '') {
      $.ajax({
        url: "ajax/check_user_name.php",
        type: 'GET', 
        data: {
          'user_name': userName
        },
        cache:false,
        async:false,
        success: function (count, status, xhr) {
          if(count > 0) {
            showCustomMessage("This user name exists. Please choose another username");
            $("#save_user").attr("disabled", "disabled");

          } else {
            $("#save_user").removeAttr("disabled");
          }
        },
        error: function (jqXhr, textStatus, errorMessage) {
          showCustomMessage(errorMessage);
        }
      });
    }

  });    
});
</script>
</body>
</html>