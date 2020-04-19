<?php

$page_title = "Approve/Verify Orders";
$destination = "order.php";
    include("header.php");

?>
<?php
if (isset($_GET['approve']) && $_GET['approve'] !== '') {
  $appod = $_GET['approve'];
  $checkm = mysqli_query($connection, "SELECT * FROM booking WHERE id = '$appod' status = 'Pending'");
  if (count([$checkm]) == 1) {
      $x = mysqli_fetch_array($checkm);
      $id = $x["id"];
      $client_name = strtoupper($x["client_name"]);
      $car_id = strtoupper($x["car_id"]);
      $plate = strtoupper($x["plate_number"]);
      $pickup_date = $x["pickup_date"];
      $pickup_time = $x["pickup_time"];
      $ext_r = $x["ext_ride"];
      $pay_meth = strtoupper($x["payment_method"]);
      $status = strtoupper($x["status"]);
      $amount = strtoupper($x["amount"]);
      $driver_name = strtoupper($x["driver_name"]);

      $getdd = "SELECT * FROM `fleet_management` WHERE id = '$car_id' && status = 'Good'";
      $res = mysqli_query($connection, $getdd);
      $rowx = mysqli_fetch_array($res);
      $car_brand = strtoupper($rowx["brand"]);
      $car_name = strtoupper($rowx["name"]);
  }
}
?>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//  for a request
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
                  <h4 class="card-title">Approve Orders</h4>
                  <p class="card-category">Make sure everything is in order</p>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Order ID:</label>
                          <input type="text" class="form-control" name="id" value="<?php echo $id; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Client's Name</label>
                          <input type="text" class="form-control" name="clients_name" value="<?php echo $client_name; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Car</label>
                          <input type="text" class="form-control" name="car" value="<?php echo $car_brand ."-" . $car_name; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pick-up Date</label>
                          <input type="date" class="form-control" name="date" value="<?php echo $pickup_date; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pick-up Time</label>
                          <input type="time" class="form-control" name="time" value="<?php echo $pickup_time; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Extra Ride?</label>
                          <input type="number" class="form-control" name="ext" value="<?php echo $ext_r; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Payment Method</label>
                          <input type="text" class="form-control" name="pay_meth" value="<?php echo $pay_meth; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <input type="text" class="form-control" name="Status" value="<?php echo $status; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Driver</label>
                          <input type="text" class="form-control" name="driver" value="<?php echo $driver_name; ?>" readonly>
                        </div>
                      </div>
                      </div>
                      <a href="client.php" class="btn btn-secondary">Back</a>
                      <button type="submit" name="submit" value="decline" class="btn btn-danger pull-right">Decline</button>
                    <button type="submit" name="submit" value="approve" class="btn btn-primary pull-right">Approve</button>
                    <div class="clearfix"></div>
                  </form>
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