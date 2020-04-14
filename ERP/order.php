<?php

$page_title = "Order";
$destination = "index.php";
    include("header.php");

?>
<?php
if (isset($_GET["message1"])) {
  $key = $_GET["message1"];
  $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
  echo '<script type="text/javascript">
  $(document).ready(function(){
      swal({
          type: "success",
          title: "Success",
          text: "Transaction Successfully Approved",
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
  $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
  echo '<script type="text/javascript">
  $(document).ready(function(){
      swal({
          type: "error",
          title: "Error",
          text: "Error updating Cache",
          showConfirmButton: false,
          timer: 2000
      })
  });
  </script>
  ';
  $_SESSION["lack_of_intfund_$key"] = 0;
}
} else if (isset($_GET["message3"])) {
  $key = $_GET["message2"];
  $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
  echo '<script type="text/javascript">
  $(document).ready(function(){
      swal({
          type: "error",
          title: "Error",
          text: "'.$out = $_SESSION["lack_of_intfund_$key"].'",
          showConfirmButton: false,
          timer: 2000
      })
  });
  </script>
  ';
  $_SESSION["lack_of_intfund_$key"] = 0;
}
} else if (isset($_GET["message8"])) {
  $key = $_GET["message8"];
  $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
  echo '<script type="text/javascript">
  $(document).ready(function(){
      swal({
          type: "success",
          title: "Success",
          text: "Transaction Has Been Declined",
          showConfirmButton: false,
          timer: 2000
      })
  });
  </script>
  ';
  $_SESSION["lack_of_intfund_$key"] = 0;
}
} else {
  echo "";
}
?>
<!-- <link href="vendor/css/addons/datatables.min.css" rel="stylesheet">
<script type="text/javascript" src="vendor/js/addons/datatables.min.js"></script> -->
<!-- Content added here -->
    <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="row">
            <div class="col-md-12">
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
                   $query = "SELECT * FROM booking";
                   $result = mysqli_query($connection, $query);
                   if ($result) {
                     $inr = mysqli_num_rows($result);
                     echo $inr;
                   }?> Booking/Order</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="tabledat" class="table" cellspacing="0" style="width:100%">
                      <thead class=" text-primary">
                      <?php
                        $query = "SELECT * FROM booking WHERE status = 'Pending'";
                        $result = mysqli_query($connection, $query);
                      ?>
                        <!-- <th>
                          ID
                        </th> -->
                        <tr>
                          <th class="th-sm">
                            Order No.
                          </th>
                        <th class="th-sm">
                          Pickup Date
                        </th>
                        <th class="th-sm">
                          Pickup Time
                        </th>
                        <th class="th-sm">
                          Clients Name
                        </th>
                        <th class="th-sm">
                          Payment Method
                        </th>
                        <th class="th-sm">Extra Ride</th>
                        <th>View</th>
                        </tr>
                        <!-- <th>Phone</th> -->
                      </thead>
                      <tbody>
                      <?php if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
                        <tr>
                         <th><?php $row["id"]; ?></th>
                          <th><?php echo $row["pickup_date"]; ?></th>
                          <th><?php echo $row["pickup_time"]; ?></th>
                          <th><?php echo $row["client_name"]; ?></th>
                          <th><?php echo $row["payment_method"]; ?></th>
                          <th><?php echo $row["status"]; ?></th>
                          <td><a href="approve_order.php?approve=<?php echo $row["id"];?>" class="btn btn-info">View</a></td>
                          </tr>
                          <!-- <th></th> -->
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
        </div>
      </div>

<?php

    include("footer.php");

?>