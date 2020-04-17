<?php

$page_title = "Add Driver";
$destination = "users.php";
    include("header.php");
?>
<?php
if (isset($_GET["message1"])) {
    $key = $_GET["message1"];
    // $out = $_SESSION["lack_of_intfund_$key"];
    $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
    echo '<script type="text/javascript">
    $(document).ready(function(){
        swal({
            type: "success",
            title: "Done",
            text: "Account Creation Successful, Check Mail For Confirmation",
            showConfirmButton: false,
            timer: 5000
        })
    });
    </script>
    ';
    $_SESSION["lack_of_intfund_$key"] = 0;
 }
} else if (isset($_GET["message2"])) {
    $key = $_GET["message2"];
    // $out = $_SESSION["lack_of_intfund_$key"];
    $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
    echo '<script type="text/javascript">
    $(document).ready(function(){
        swal({
            type: "error",
            title: "Error",
            text: "Account Creation Error",
            showConfirmButton: false,
            timer: 4000
        })
    });
    </script>
    ';
    $_SESSION["lack_of_intfund_$key"] = 0;
  }
}
else if (isset($_GET["message3"])) {
    $key = $_GET["message3"];
    // $out = $_SESSION["lack_of_intfund_$key"];
    $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
    echo '<script type="text/javascript">
    $(document).ready(function(){
        swal({
            type: "error",
            title: "Existing Account",
            text: "Account Has Been Created Before",
            showConfirmButton: false,
            timer: 4000
        })
    });
    </script>
    ';
    $_SESSION["lack_of_intfund_$key"] = 0;
  }
}
?>
<!-- Content added here -->
    <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add New Staff</h4>
                  <p class="card-category">Fill in all important data</p>
                </div>
                <div class="card-body">
                  <form action="../functions/driver_upload.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" class="form-control" name="username" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">E-mail</label>
                          <input type="email" class="form-control" name="email">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="password">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
        <div class="fileinput-new thumbnail img-circle img-raised">
    	<img src="https://epicattorneymarketing.com/wp-content/uploads/2016/07/Headshot-Placeholder-1.png" rel="nofollow" alt="...">
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
        <div>
        <span class="btn btn-raised btn-round btn-rose btn-file">
            <span class="fileinput-new">Add Photo</span>
    	<span class="fileinput-exists">Change</span>
    	<input type="file" name="pics" /></span>
            <br />
            <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
        </div>
    </div>
  </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Create Driver</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="../assets/img/faces/marc.jpg" />
                  </a>
                </div>
                <!-- Get session data and populate user profile -->
                <?php
                $fullname = $_SESSION["username"];
                $int_name = $_SESSION["usertype"];
                ?>
                <div class="card-body">
                  <h4 class="card-title"> <?php echo $fullname?></h4>
                  <p class="card-description">
                  <?php echo $int_name?>
                  </p>
                  <!-- <a href="#pablo" class="btn btn-primary btn-round">Follow</a> -->
                </div>
              </div>
            </div>
          </div>
          <!-- /content -->
        </div>
      </div>

<?php

    include("footer.php");

?>