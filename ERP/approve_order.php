<?php

$page_title = "Approve/Verify Orders";
$destination = "order.php";
    include("header.php");

?>
<?php
if (isset($_GET['approve']) && $_GET['approve'] !== '') {
  $appod = $_GET['approve'];
  $checkm = mysqli_query($connection, "SELECT * FROM booking WHERE id = '$appod' && status = 'Pending'");
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
      $drive_id = $x["driver_id"];
      $driver_name = strtoupper($x["driver_name"]);

      $getdd = "SELECT * FROM `fleet_management` WHERE id = '$car_id' && status = 'Good'";
      $res = mysqli_query($connection, $getdd);
      $rowx = mysqli_fetch_array($res);
      $car_brand = strtoupper($rowx["brand"]);
      $car_name = strtoupper($rowx["name"]);
      $fleetamt = $rowx["amount"];
      $used = $rowx["currently_used"];

    //   institution account
    
    $intact = "SELECT * FROM `institution_account` WHERE account_no = 'XK20200417'";
      $rex = mysqli_query($connection, $intact);
      $rox = mysqli_fetch_array($rex);
      $int_int = $rox["total_interest_derived"];
      $acct_bal = $rox["balance"];
      $tot_bus_prof = $rox["total_business_profit"];
      $tot_collected_card = $rox["total_collected_card"];
      $tot_collected_cash = $rox["total_collected_cash"];

    //   drivers account

    $dvact = "SELECT * FROM `account` WHERE user_id = '$drive_id'";
      $red = mysqli_query($connection, $dvact);
      $rod = mysqli_fetch_array($red);
      $drive_amount = $rod["amount"];
      $drive_no = $rod["account_no"];

    //   calculation for driver
    $driver_amount = $amount - (($int_int / 100) * $amount);

    // institution account calculation
    $cash = $amount + $acct_bal;
    $acct_prof = ($int_int / 100) * $amount;
    $total_acct_prof = $int_int + $acct_prof;
    if ($pay_meth == "card") {
        $mixpay = $tot_collected_card + $amount;
        $mixcash = $tot_collected_cash;
    } else {
        $mixcash = $tot_collected_cash + $amount;
        $mixpay = $tot_collected_card;
    }

    $fleet_amt = $fleetamt - 1;
    $fleet_used = $used + 1;
  }
}
?>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//  for a request
 $ts = date('Y-m-d H:i:s');
 $approve = $_POST['submit'];
 $decline = $_POST['submit'];

 if ($approve == 'approve') {
    $iupqx = "UPDATE institution_account SET balance = '$cash',
    total_business_profit = '$total_acct_prof', total_collected_card = '$mixpay', total_collected_cash = '$mixcash',
    last_active = '$ts'  WHERE account_no = 'XK20200417'";
    $res = mysqli_query($connection, $iupqx);
    // update booking
    if ($res) {
        $dup = "UPDATE account SET amount = '$driver_amount' WHERE user_id = '$drive_id'";
        $res1 = mysqli_query($connection, $dup);
        if ($res1) {
            $intrans = "INSERT INTO `account_tansaction` (`transaction_id`,
            `account_no`, `user_id`, `amount`, `transaction_type`,
            `driver_account`, `x_interest_amount`)
             VALUES ('{$id}', '{$drive_no}', '{$drive_id}', '{$amount}',
             '{$pay_meth}', '{$driver_amount}', '{$acct_prof}')";

             $res2 = mysqli_query($connection, $intrans);

             if ($res2) {
                 $fup = "UPDATE fleet_management SET amount = '$fleet_amt', currently_used = '$fleet_used'
                 WHERE id = '$car_id'";
                 $res3 = mysqli_query($connection, $fup);
                 if ($res3) {
                     $bup = "UPDATE booking SET status = 'ORDERED' WHERE id = '$id'";
                     $res4 = mysqli_query($connection, $bup);
                     if($res4) {
                        echo '<script type="text/javascript">
  $(document).ready(function(){
      swal({
          type: "success",
          title: "Success",
          text: "Successfully Approved",
          showConfirmButton: false,
          timer: 2000
      })
  });
  </script>
  ';
  $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                     } else {
                        //  notify booking
                        echo '<script type="text/javascript">
                        $(document).ready(function(){
                            swal({
                                type: "error",
                                title: "Error",
                                text: "Approval Error",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        });
                        </script>
                        ';
                        $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                     }
                 } else {
                    //  notify fleet
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                            type: "error",
                            title: "Error",
                            text: "Approval Error",
                            showConfirmButton: false,
                            timer: 2000
                        })
                    });
                    </script>
                    ';
                    $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                 }
             } else {
                //  notify account transaction
                echo '<script type="text/javascript">
                $(document).ready(function(){
                    swal({
                        type: "error",
                        title: "Error",
                        text: "Approval Error",
                        showConfirmButton: false,
                        timer: 2000
                    })
                });
                </script>
                ';
                $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
             }
        } else {
            // notify driver
            echo '<script type="text/javascript">
                        $(document).ready(function(){
                            swal({
                                type: "error",
                                title: "Error",
                                text: "Approval Error",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        });
                        </script>
                        ';
                        $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        }
    } else {
        // notify institution
        echo '<script type="text/javascript">
                        $(document).ready(function(){
                            swal({
                                type: "error",
                                title: "Error",
                                text: "Approval Error",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        });
                        </script>
                        ';
                        $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
 } else {
    $digits = 10;
    $randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
     if (isset($_GET['approve']) && $_GET['approve'] !== '') {
       $appe = $_GET['approve'];
       $dc = "declined";
       $take = "UPDATE booking SET `status` = '$dc' WHERE id = '$appe'";
       $deny = mysqli_query($connection, $take);
       if ($deny) {
        // notify
        echo '<script type="text/javascript">
  $(document).ready(function(){
      swal({
          type: "success",
          title: "Error",
          text: "Declined Order",
          showConfirmButton: false,
          timer: 2000
      })
  });
  </script>
  ';
  $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
       } else {
        // notify
        echo '<script type="text/javascript">
        $(document).ready(function(){
            swal({
                type: "error",
                title: "Error",
                text: "Approval Error",
                showConfirmButton: false,
                timer: 2000
            })
        });
        </script>
        ';
        $URL="order.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
       }
     }
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
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Plate Number</label>
                          <input type="text" class="form-control" name="plate" value="<?php echo $plate; ?>" readonly>
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