<?php
    session_start();
    if(!$_SESSION["usertype"] == "client"){
      header("location: index.php");
      exit;
  }
?>

<?php
  // get connections for all pages
  include("functions/connect.php");
?>
<?php
//active user
$activecode = "Active";
// working on the time stamp right now
$ts = date('Y-m-d H:i:s');
$acuser = $_SESSION["username"];
$activeq = "UPDATE users SET users.status ='$activecode', users.last_logged = '$ts' WHERE users.username ='$acuser'";
$rezz = mysqli_query($connection, $activeq);
?>

<head>
  <title><?php echo "Xkruise - Booking"?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- accordion -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="../datatable/jquery-3.3.2.js"></script>
  <script src="../datatable/jquery.dataTables.min.js"></script>
  <script src="../datatable/dataTables.bootstrap.min.js"></script>
  <script src="../datatable/DropdownSelect.js"></script>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.3/materia/bootstrap.min.css"> -->
  <style>
    div[data-acc-content] { display: none;  }
    div[data-acc-step]:not(.open) { background: #f2f2f2;  }
    div[data-acc-step]:not(.open) h5 { color: #777;  }
    div[data-acc-step]:not(.open) .badge-primary { background: #ccc;  }
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <?php
              if($page_title == "Dashboard"){
            ?>
            <!-- <a class="btn btn-primary" href="#pablo"><i class="fa fa-caret-left"></i> Back</a> -->
            <?php
              }else{            ?>

              <a class="btn btn-primary" href="<?php echo $destination ?>"><i class="fa fa-caret-left"></i> Back</a>
              
              <?php
                }
              ?>
          
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">notifications</i>
                </a>
              </li>
              <!-- user setup -->
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <!-- Insert user display name here -->
                  <!-- <p class="d-lg-none d-md-block"> -->
                    <?php echo $_SESSION["username"]; ?>
                  <!-- </p> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="functions/logout.php">Log out</a>
                </div>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>