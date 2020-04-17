<?php

$page_title = "Add Car";
$destination = "users.php";
    include("header.php");
?>
<!-- Content added here -->
    <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add new Car</h4>
                  <p class="card-category">Fill in all important data</p>
                </div>
                <div class="card-body">
                  <form action="../functions/fleet_upload.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category</label>
                          <input type="text" class="form-control" name="brand">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" class="form-control" name="name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Plate Number</label>
                          <input type="email" class="form-control" name="plate_number">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Quantity</label>
                          <input type="text" class="form-control" name="amount">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                  <div class="col-md-4">
    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
        <!-- <div class="fileinput-new thumbnail img-circle img-raised">
    	<img src="https://epicattorneymarketing.com/wp-content/uploads/2016/07/Headshot-Placeholder-1.png" rel="nofollow" alt="...">
        </div> -->
        <!-- <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div> -->
        <div>
        <span class="btn btn-raised btn-round btn-rose btn-file">
            <span class="fileinput-new">Add Image</span>
    	<span class="fileinput-exists">Change</span>
    	<input type="file" name="car_img" /></span>
            <br />
            <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
        </div>
    </div>
  </div> <br>
  <div class="col-md-4">
    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
        <!-- <div class="fileinput-new thumbnail img-circle img-raised">
    	<img src="https://epicattorneymarketing.com/wp-content/uploads/2016/07/Headshot-Placeholder-1.png" rel="nofollow" alt="...">
        </div> -->
        <!-- <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div> -->
        <div>
        <span class="btn btn-raised btn-round btn-rose btn-file">
            <span class="fileinput-new">Add Document</span>
    	<span class="fileinput-exists">Change</span>
    	<input type="file" name="document" /></span>
            <br />
            <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
        </div>
    </div>
  </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <select name="stat" id="" class="form-control">
                          <option value="good">Good Condition</option>
                            <option value="bad">Bad Condition</option>
                            <option value="worse">Not Good For Work</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Create Profile</button>
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