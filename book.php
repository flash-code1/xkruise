<!DOCTYPE html>
<html lang="en">
 
<?php 
include("client.php");
?>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div style="margin-top: 20px;"></div>
				<div class="row">
					<div class="booking-form">
<div class="card card-nav-tabs">
  <div class="card-header card-header-warning">
    Order Ride
  </div>
  <div class="card-body">
	  <form action="">
		  <div class="row">
			  <div class="col-md-6">
				  <div class="form-group">
                 <label class="label-control">PickUp Date</label>
                 <input type="date" class="form-control datetimepicker" name="date"/>
                  </div>
			  </div>
			  <div class="col-md-6">
				  <div class="form-group">
                 <label class="label-control">PickUp Time</label>
                 <input type="time" class="form-control datetimepicker" name="date"/>
                  </div>
			  </div>
			  <div class="form-group col-md-3">
                   <label for="inputState">Select Ride</label>
                   <select id="inputState" name="car" class="form-control" id="client_name">
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
                 <select id="inputState" name="extracars" class="form-control" id="price_of_cars">
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
        <input class="form-check-input" type="radio" name="card" id="exampleRadios1" value="1" checked >
        Card
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
<div class="form-check form-check-radio">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="card" id="exampleRadios2" value="2">
        Cash
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
				  </div>
			  </div>

			  <div>
			  <button type="submit" class="btn btn-primary btn-round btn-lg">
				  ORDER
			  </button>
			  </div>
		  </div>
	  </form>
    <!-- <h4 class="card-title">Special title treatment</h4>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#0" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>