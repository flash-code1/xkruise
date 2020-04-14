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
                  <h4 class="card-title ">Fleet Management</h4>
                  <script>
                  $(document).ready(function() {
                  $('#tabledat').DataTable();
                  });
                  </script>
                  <!-- Insert number users institutions -->
                  <p class="card-category"><?php
                   $query = "SELECT * FROM fleet_management";
                   $result = mysqli_query($connection, $query);
                   if ($result) {
                     $inr = mysqli_num_rows($result);
                     echo $inr;
                   }?> Fleet of Cars</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="tabledat" class="table" cellspacing="0" style="width:100%">
                      <thead class=" text-primary">
                      <?php
                        $query = "SELECT * FROM fleet_management";
                        $result = mysqli_query($connection, $query);
                      ?>
                        <!-- <th>
                          ID
                        </th> -->
                        <tr>
                        <th class="th-sm">
                          Category
                        </th>
                        <th class="th-sm">
                          Name
                        </th>
                        <th class="th-sm">
                          Plate Number
                        </th>
                        <th class="th-sm">
                          Image
                        </th>
                        <th class="th-sm">Total Amount</th>
                        <th class="th-sm">Currently Booked</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        </tr>
                        <!-- <th>Phone</th> -->
                      </thead>
                      <tbody>
                      <?php if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
                        <tr>
                        <?php $row["id"]; ?>
                          <th><?php echo $row["brand"]; ?></th>
                          <th><?php echo $row["name"]; ?></th>
                          <th><?php echo $row["plate_number"]; ?></th>
                          <th><?php echo $row["car_img"]; ?></th>
                          <th><?php echo $row["amount"]; ?></th>
                          <th><?php echo $row["currently_used"]; ?></th>
                          <th><?php echo $row["status"];?></th>
                          <td><a href="fleet_update.php?approve=<?php echo $row["id"];?>" class="btn btn-info">Edit</a></td>
                          <td><a href="fleet_management.php" class="btn btn-info">Add</a></td>
                          </tr>
                          <!-- <th></th> -->
                          <?php }
                          }
                          else {
                            echo '
                            <a href="fleet_management.php" class="btn btn-info">Add</a>
                            ';
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