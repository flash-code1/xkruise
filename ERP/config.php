<?php

$page_title = "Configuration";
$destination = "index.php";
    include("header.php");

?>
<!-- Content added here -->
    <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Configuration:</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons">bug_report</i> Password Settings
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="material-icons">supervisor_account</i> Roles
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#products" data-toggle="tab">
                            <i class="material-icons">visibility</i> Products
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="tab">
                            <i class="material-icons">visibility_off</i> Marker Checker Permissions
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <div class="card-title">Auto Logout</div>
                      <form action="">
                        <div class="form-group">
                          <label for="">Toggle on and off </label>
                          <select name="" class="form-control" id="">
                            <option value="On">On</option>
                            <option value="Off">Off</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Duration</label>
                          <input type="number" name="" class="form-control" id="">
                        </div>
                        <button class="btn btn-primary">Update</button>
                      </form>
                    </div>
                    <div class="tab-pane" id="messages">
                      <button class="btn btn-primary"><i class="fa fa-plus"> </i> Add New Role</button>
                      <table class="table">
                        <thead>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Active</th>
                        </thead>
                        <tbody>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="products">
                      <a href="manage_product.php" class="btn btn-primary"> Create New Product</a>
                      <div class="table-responsive">
                  <script>
                  $(document).ready(function() {
                  $('#tabledat4').DataTable();
                  });
                  </script>
                    <table id="tabledat4" class="table" style="width: 100%;">
                      <thead class=" text-primary">
                      <?php
                        $query = "SELECT * FROM product WHERE int_id ='$sessint_id'";
                        $result = mysqli_query($connection, $query);
                      ?>
                        <!-- <th>
                          ID
                        </th> -->
                        <th>Name</th>
                        <th>
                          Description
                        </th>
                        <th>
                          Product Group
                        </th>
                        <th>
                          Edit
                        </th>
                      </thead>
                      <tbody>
                      <?php if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
                        <tr>
                        <?php $row["id"]; ?>
                          <th><?php echo $row["name"]; ?></th>
                          <th><?php echo $row["description"]; ?></th>
                          <th><?php echo $row["short_name"]; ?></th>
                          <td><a href="update_product.php?edit=<?php echo $row["id"];?>" class="btn btn-info">Edit</a></td>
                        </tr>
                        <?php }
                          }
                          else {
                            echo "0 Document";
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
          <!-- / -->
        </div>
      </div>

<?php

    include("footer.php");

?>