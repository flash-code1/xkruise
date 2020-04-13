<!DOCTYPE html>
<html lang="en">
 
<?php 
include("client.php");
?>

<body>
<div class="content">
        <div class="container-fluid">
		  <!-- your content here -->
		  <div style="margin-top: 50px;"></div>
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Order Now</h4>
                  <p class="card-category">Fill in all important data</p>
                </div>
                <div class="card-body">
                  <form action="functions/book_upload.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    </div>
                    <div class="row">
					<div class="col-md-6">
				  <div class="form-group">
                 <label class="label-control">PickUp Date</label>
                 <input type="date" class="form-control datetimepicker" name="pickup_date"/>
                  </div>
			  </div>
			  <div class="col-md-6">
				  <div class="form-group">
                 <label class="label-control">PickUp Time</label>
                 <input type="time" class="form-control datetimepicker" name="pickup_time"/>
                  </div>
            </div>
            <div class="col-md-6">
				  <div class="form-group">
          <div class="input-group">
         <div class="input-group-prepend">
             <span class="input-group-text">
               <i class="material-icons">navigation</i>
             </span>
            </div>
            <input type="text" name="location" class="form-control" placeholder="Location">
          </div>
          </div>
            </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-3">
                   <label for="inputState">Select Ride</label>
                   <select id="inputState" name="car_id" class="form-control" id="client_name">
				   <option selected>Choose...</option>
				   <?php
				   function fill_client($connection) {
					$org = "SELECT * FROM fleet_management";
					$res = mysqli_query($connection, $org);
					$out = '';
					while ($row = mysqli_fetch_array($res))
					{
					  $out .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
					}
					return $out;
				  }
				   ?>
                   <?php echo fill_client($connection); ?>
                 </select>
			  </div>
			  <div class="col-md-6">
				  <div class="form-group">
                 <label class="label-control">Extra Cars?</label>
                 <select id="inputState" name="ext_ride" class="form-control" id="price_of_cars">
           <option value="1">...</option>
					 <option value="2">ONE</option>
					 <option value="3">TWO</option>
					 <option value="4">THREE</option>
                 </select>
                  </div>
			  </div>
			  <div class="col-md-4">
				  <div class="form-group">
				  <div class="form-check form-check-radio">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="pm" id="exampleRadios1" value="cash" checked >
        Card
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
<div class="form-check form-check-radio">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="pm" id="exampleRadios2" value="card">
        Cash
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
				  </div>
			  </div>
                    </div>
                    <button type="submit" class="btn btn-warning pull-right">Order Now</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="assets/img/faces/marc.jpg" />
                  </a>
                </div>
                <!-- Get session data and populate user profile -->
                <?php
                $fullname = $_SESSION["username"];
                ?>
                <div class="card-body">
                  <h4 class="card-title"> <?php echo $fullname?></h4>
                  <!-- <a href="#pablo" class="btn btn-primary btn-round">Follow</a> -->
                </div>
              </div>
            </div>
          </div>
          <!-- /content -->
        </div>
      </div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
