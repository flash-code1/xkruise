<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Xride Booking</title>

	<!-- Google font -->
	<link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css" />

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap2.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style2.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="booking-bg">
							<div class="form-header" style="margin-top: 120px;">
								<h2>Book Your Ride Now!</h2>
								<p>Get to the Airport at a very cheap price</p>
								<p> <b> NGN 3,000</b> From AnyWhere is Abuja</p>
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