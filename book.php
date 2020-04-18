<!DOCTYPE html>
<html lang="en">
<!-- for map -->
<?php 
include("client.php");
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
          title: "Success",
          text: "Booking Successful",
          showConfirmButton: false,
          timer: 2000
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
          text: "Booking Error",
          showConfirmButton: false,
          timer: 2000
      })
  });
  </script>
  ';
  $_SESSION["lack_of_intfund_$key"] = 0;
}
} else if (isset($_GET["message3"])) {
  $key = $_GET["message3"];
  // $out = $_SESSION["lack_of_intfund_$key"];
  $tt = 0;
if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
  echo '<script type="text/javascript">
  $(document).ready(function(){
      swal({
          type: "error",
          title: "Error",
          text: "Choose A Payment Option",
          showConfirmButton: false,
          timer: 2000
      })
  });
  </script>
  ';
  $_SESSION["lack_of_intfund_$key"] = 0;
}
}
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
                <div id="map" style="height: 50vh; margin-bottom: 10px; display: none;">
                </div>
  <p id="current_position"></p>
                <button id="showMe" class="btn center-align">
    <i class="material-icons">
        my_location
    </i>
    Use My Location
  </button>
                  <form action="functions/book_upload.php" method="POST" enctype="multipart/form-data" id="billingAddress">
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
					  $out .= '<option value="'.$row["id"].'">'.$row["brand"].' '.$row["name"].'</option>';
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
           <option value="0">...</option>
					 <option value="1">ONE</option>
					 <option value="2">TWO</option>
					 <option value="3">THREE</option>
                 </select>
                  </div>
			  </div>
			  <div class="col-md-4">
				  <div class="form-group">
				  <div class="form-check form-check-radio">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="pm" id="exampleRadios1" value="card" disabled>
        Card
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
<div class="form-check form-check-radio">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="pm" id="exampleRadios2" value="cash" checked>
        Cash
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
				  </div>
        </div>
        <div id="locationList"></div> <br/>
        <div class="col-md-12">
          <div class="form-group">
          <label class="bmd-label-floating">Address</label>
          <input type="text" name="location" id="address" class="form-control">
          </div>
        </div>
          <!-- for locality -->
          <div class="col-md-4">
          <div class="form-group">
          <label class="bmd-label-floating">Locality</label>
          <input type="text" name="locality" id="locality" class="form-control">
          </div>
          </div>
          <!-- for city  -->
          <div class="col-md-4">
          <div class="form-group">
          <label class="bmd-label-floating">City/District/Town</label>
          <input type="text" name="city" id="city" class="form-control">
          </div>
          </div>
          <!-- pin code -->
          <div class="col-md-4">
          <div class="form-group">
          <label class="bmd-label-floating">Postal Code</label>
          <input type="text" name="postal" id="postal_code" class="form-control">
          </div>
          </div>
          <!-- land mark -->
          <div class="col-md-4">
          <div class="form-group">
          <label class="bmd-label-floating">Land Mark</label>
          <input type="text" name="land_mark" id="landmark" class="form-control">
          </div>
          </div>
          <!-- state -->
          <div class="col-md-4">
          <div class="form-group">
          <label class="bmd-label-floating">State</label>
          <input type="text" name="state" id="state" class="form-control">
          </div>
          </div>
            </div>
                    </div>
                    <button type="submit" class="btn btn-warning pull-right">Order Now</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
                <script src="js/main.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AlzaSyCKjmDdU6X9UBNPO0nl-gHdpFhvngkxXAY"></script>
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
                $cid = $_SESSION["id"];
                ?>
                <div class="card-body">
                  <h4 class="card-title"> <?php echo $fullname?></h4>
                  <h4 class="card-title">Balance: $20.00</h4>
                  <a class="dropdown-item" href="functions/logout.php">Logout</a>
                  <!-- <a href="#pablo" class="btn btn-primary btn-round">Follow</a> -->
                </div>
              </div>
            </div>
            <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                  <h4 class="card-title ">Daily Order</h4>
                  <script>
                  $(document).ready(function() {
                  $('#tabledat').DataTable();
                  });
                  </script>
                  <!-- Insert number users institutions -->
                  <p class="card-category"><?php
                  $stat = "Not Verified";
                   $query = "SELECT * FROM booking WHERE client_id ='$cid'";
                   $result = mysqli_query($connection, $query);
                   if ($result) {
                     $inr = mysqli_num_rows($result);
                     echo $inr;
                   }?> Order</p>
                </div>
              <div class="card-body">
              <div class="table-responsive">
  <table class="table table-shopping">
      <thead>
      <?php
          $query = "SELECT * FROM booking  WHERE client_id ='$cid' && status = 'Pending'";
          $result = mysqli_query($connection, $query);
        ?>
          <tr>
              <th class="text-center">Order Number</th>
              <th class="th-description">Pickup Date</th>
              <th class="text-right">Pickup Time</th>
              <th class="text-right">Extra Car</th>
              <th class="text-right">Amount</th>
              <th class="text-right">Driver's Name</th>
              <th>View</th>
              <th></th>
          </tr>
      </thead>
      <tbody>
      <?php if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
          <tr>
              <td>
               <small><?php echo $row["id"]; ?></small>
              </td>
              <td class="td-name">
                <?php echo $row["pickup_date"]; ?>
              </td>
              <td>
              <?php echo $row["pickup_time"]; ?>
              </td>
              <td>
              <?php echo $row["ext_ride"]; ?>
              </td>
              <td class="td-number">
              <?php echo $row["amount"]; ?>
              </td>
              <td>
              <?php echo $row["driver_name"]; ?>
              </td>
              <td class="td-number">
                  <div class="btn-group">
                      <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">face</i> </button>
                  </div>
              </td>
              <td class="td-actions">
                  <button type="button" rel="tooltip" data-placement="left" title="Remove item" class="btn btn-simple">
                      <i class="material-icons">close</i>
                  </button>
              </td>
          </tr>
          <?php }
                          }
                          else {
                            // echo "0 Staff";
                          }
                          ?>
      </tbody>
  </table>
</div>
       </div>
         </div>
            </div>
          </div>
          <!-- /content -->
        </div>
      </div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
