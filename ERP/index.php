<?php

    $page_title = "Dashboard";
    include("header.php");

?>
<!-- Content added here -->
    <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="row">
            <!-- Card displays clients -->
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <p class="card-category">Clients</p>
                  <!-- Populate with number of existing clients -->
                  <h3 class="card-title"><?php
                   $query = "SELECT * FROM users WHERE usertype = 'client'";
                   $result = mysqli_query($connection, $query);
                   if ($result) {
                     $inr = mysqli_num_rows($result);
                     echo $inr;
                   }?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- Get current update time and display -->
                    <!-- <i class="material-icons">update</i> Just Updated -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /clients -->
            <!-- Portfolio at risk -->
            <!-- not in use yet -->
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                  <i class="material-icons">local_taxi</i>
                  </div>
                  <p class="card-category">Total/Good Fleet</p>
                  <h3 class="card-title"><?php
                   $qry = "SELECT * FROM fleet_management";
                   $qry2 = "SELECT * FROM fleet_management WHERE status = 'good'";
                   $rx1 = mysqli_query($connection, $qry);
                   $rx2 = mysqli_query($connection, $qry2);
                   if ($result) {
                     $inr = mysqli_num_rows($rx2);
                     $all = mysqli_num_rows($rx1);
                     echo $all ."/".$inr;
                   }?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- <i class="material-icons">warning</i> Just Updated -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /par -->
            <!-- logged in users -->
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <p class="card-category">Total/Active Staff</p>
                  <!-- Populate with number of logged in staff -->
                  <h3 class="card-title"><?php
                   $query1 = "SELECT * FROM users WHERE status = 'Active' && usertype = 'staff'";
                   $query3 = "SELECT * FROM users WHERE usertype = 'staff'";
                   $result1 = mysqli_query($connection, $query1);
                   $res3 = mysqli_query($connection, $query3);
                   if ($result) {
                     $inr = mysqli_num_rows($result1);
                     $all = mysqli_num_rows($res3);
                     echo $all ."/".$inr;
                   }?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- Get current update time and display -->
                    <!-- <i class="material-icons">update</i> Just Updated -->
                  </div>
                </div>
              </div>
            </div>
            <!-- g -->
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person_pin</i>
                  </div>
                  <p class="card-category">Total/Active Drivers</p>
                  <!-- Populate with number of logged in staff -->
                  <h3 class="card-title"><?php
                   $query = "SELECT * FROM users WHERE status = 'Active' && usertype = 'driver'";
                   $query2 = "SELECT * FROM users WHERE usertype = 'driver'";
                   $res2 = mysqli_query($connection, $query);
                   $result = mysqli_query($connection, $query2);
                   if ($result) {
                     $inr = mysqli_num_rows($result);
                     $all = mysqli_num_rows($res2);
                     echo $all ."/".$inr;
                   }?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- Get current update time and display -->
                    <!-- <i class="material-icons">update</i> Just Updated -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /users -->
            <!-- loan balance -->
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">account_balance_wallet</i>
                  </div>
                  <p class="card-category">Companies Revenue</p>
                  <!-- Populate with the total value of outstanding loans -->
                  <?php
                  $re = "SELECT * from institution_account";
                  $resultxx = mysqli_query($connection, $re);
                  if (count([$resultxx]) == 1) {
                  $jk = mysqli_fetch_array($resultxx); 
                  $sum = $jk['balance'];
                  ?>
                  <h3 class="card-title">NGN - <?php echo $sum; ?></h3>
                  <?php
                  }
                  ?>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- Get current update time and display -->
                    <!-- <i class="material-icons">update</i> Just Updated -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /lb -->
          </div>
          <!-- /row -->
          <div class="row">
            <!-- populate with frequency of loan disbursement -->
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Daily Transaction</h4>
                  <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> Profit This Week</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- <i class="material-icons">access_time</i> updated 4 minutes ago -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /row -->
        </div>
      </div>

<?php

    include("footer.php");

?>