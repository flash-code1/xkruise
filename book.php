<!DOCTYPE html>
<html lang="en">
 
<?php 
include("client.php");
?>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
<div class="card card-background" style="background-image: url('https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=750&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D')">
  <div class="card-body">
    <h6 class="card-category text-info">Productivy Apps</h6>
    <a href="#pablo">
      <h3 class="card-title">The Best Productivity Apps on Market</h3>
      </a>
      <p class="card-description">
      Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
      </p>
    <a href="#pablo" class="btn btn-white btn-link">
      <i class="material-icons">subject</i> Read Article
    </a>
    <a href="#pablo" class="btn btn-white btn-link">
      <i class="material-icons">watch_later</i> Watch Later
    </a>
  </div>
</div>

<div class="card card-nav-tabs">
  <div class="card-header card-header-warning">
    Order Ride
  </div>
  <div class="card-body">
	  <form action="">
		  <div class="row">
			  <div class="col-md-6">
			  <script>
		 $('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});
</script>
				  <div class="form-group">
    <label class="label-control">Airport Datetime PickUp</label>
    <input type="text" class="form-control datetimepicker" value="21/06/2018"/>
   </div>
			  </div>
		  </div>
	  </form>
    <!-- <h4 class="card-title">Special title treatment</h4>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#0" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>



						<form>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Airport- Pickup</span>
										<input class="form-control" type="date" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Time</span>
										<input class="form-control" type="time" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Adults</span>
										<select class="form-control">
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Children</span>
										<select class="form-control">
											<option>0</option>
											<option>1</option>
											<option>2</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Car Type</span>
										<select class="form-control">
											<option>Sedan (Default)</option>
											<option>SUV</option>
											<option>Minivan</option>
											<option>Maruti Suzuki Ciaz</option>
											<option>MVP</option>
											<option>Crossover</option>
											<option>Convertible</option>
											<option>Hatch Back</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Extra Car</span>
										<select class="form-control">
											<option>0 (Default)</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
							</div>
							<div class="col-md-4">
                    <p><label for="">Payment Type:</label></p>
                    <div class="form-check form-check-inline">
                      <label class="form-check-label">
                          <input class="form-check-input" name="cash" type="checkbox" value="1">
                          CASH
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <label class="form-check-label">
                          <input class="form-check-input" name="card" type="checkbox" value="">
                          CARD
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                      </label>
                    </div>
                  </div>
				  <div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Location</span>
										<input class="form-control" type="textarea" required>
									</div>
								</div>
							<div class="form-btn">
								<button class="submit-btn">Book</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>