<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  if($_SESSION["usertype"] == "super_admin"){
    header("location: index.php");
    exit;
  } 
  elseif($_SESSION["usertype"] == "admin"){
    header("location: ./modules/admin/dashboard.php");
    exit;
  }
//   elseif($_SESSION["usertype"] == "staff"){
//       if($_SESSION["employee_status"] == "Employed"){
//         header("location: mfi/index.php");
//       }
//       elseif($_SESSION["employee_status"] == "Decommisioned"){
//         $err = "Sorry, you are not allowed to login";
//         $password = "";
//       }
//     exit;
//   }
}
 
// Include config file
require_once "functions/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT users.id, staff.user_id, users.int_id, users.username, users.fullname, users.usertype,staff.employee_status, users.password, org_role, display_name FROM staff JOIN users ON users.id = staff.user_id WHERE users.username = ?";
        // $sqlj = "SELECT users.id, users.int_id, users.username, users.fullname, users.usertype, users.password, org_role, display_name FROM staff JOIN users ON users.id = staff.user_id WHERE users.username = "sam"";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $user_id, $int_id, $username, $fullname, $usertype, $employee_status, $hashed_password, $org_role, $display_name);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            session_regenerate_id();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["int_id"] = $int_id;
                            $_SESSION["username"] = $username;
                            $_SESSION["usertype"] = $usertype;
                            $_SESSION["fullname"] = $fullname;
                            $_SESSION["org_role"] = $org_role;
                            $_SESSION["employee_status"] = $employee_status;
                            // $_SESSION["lastname"] = $lastname;
                            session_write_close();                            
                            //run a quick code to show active user
                            // Redirect user to welcome page
                            if ($stmt->num_rows ==1 && $_SESSION["usertype"] =="super_admin") {
                              header("location: index.php");
                            }elseif ($stmt->num_rows ==1 && $_SESSION["usertype"]=="admin"){
                                header("location: mfi/index.php");
                            //   header("location: ./mfi/admin/dashboard.php");
                            }
                            elseif ($stmt->num_rows ==1 && $_SESSION["usertype"]=="staff") {
                                if($_SESSION["employee_status"] == "Employed"){
                                    header("location: mfi/index.php");
                                  }
                                  elseif($_SESSION["employee_status"] == "Decommisioned"){
                                    $err = "Sorry You cannot login";
                                    $password = "";
                                  }
                            }
                            elseif ($stmt->num_rows ==1 && $_SESSION["usertype"]=="super_staff") {
                                header("location: ./modules/staff/dashboard.php");
                              }
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}

include('functions/config.php');

?>

<html lang="en">
<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- test -->
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />


  <link href="assetsk/css/bootstrap.css" rel="stylesheet" />

	<link href="assetsk/css/login-register.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

	<script src="assetsk/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assetsk/js/bootstrap.js" type="text/javascript"></script>
	<script src="assetsk/js/login-register.js" type="text/javascript"></script>
</head>
<body>
    <div class="wrapper">
        <div class="content justify-content-between">
            <div class="container">
                <!-- Login form -->
                <!-- <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                 <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Log in</a>
                 <a class="btn big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></div>
            <div class="col-sm-4"></div>
        </div> -->
                <div class="row">
                <div class="modal fade login" data-backdrop="static" id="loginModal">
		      <div class="modal-dialog login animated">
    		      <div class="modal-content">
    		         <div class="modal-header">
                        <h4 class="modal-title">Login with Xkruise</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box">
                             <div class="content">
                                <div class="social">
                                    <a class="circle github" href="#">
                                        <i class="fa fa-github fa-fw"></i>
                                    </a>
                                    <a id="google_login" class="circle google" href="#">
                                        <i class="fa fa-google-plus fa-fw"></i>
                                    </a>
                                    <a id="facebook_login" class="circle facebook" href="#">
                                        <i class="fa fa-facebook fa-fw"></i>
                                    </a>
                                </div>
                                <div class="division">
                                    <div class="line l"></div>
                                      <span>or</span>
                                    <div class="line r"></div>
                                </div>
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" accept-charset="UTF-8">
                                    <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                    <span class="help-block"><?php echo $username_err; ?></span>
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                    <input class="btn btn-default btn-login" type="button" value="Login" onclick="loginAjax()">
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" html="{:multipart=>true}" data-remote="true" accept-charset="UTF-8">
                                <input id="email" class="form-control" type="email" placeholder="Email" name="email">
                                <input id="username" class="form-control" type="text" placeholder="Username" name="username">
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                <!-- <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation"> -->
                                <input class="btn btn-default btn-register" type="button" value="Create account" name="commit">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Already have an account?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>
    		      </div>
		      </div>
          </div>
          <script type="text/javascript">
    $(document).ready(function(){
        openLoginModal();
    });
</script>
          <!-- someh\thing -->
                    <!-- <div class="col-md-7" style="margin-left:auto; margin-right:auto;">
                    <div class="card">
                        <div class="card-header card-header-primary">
                        <h4 class="card-title">Login</h4>
                        <h4 class="card-title"><?php echo $err;?></h4>
                        <p class="card-category">Sign in</p>
                        </div>
                        <div class="card-body"> -->
                        <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                    <label class="bmd-label-floating">Email</label>
                                    <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                                    <span class="help-block"><?php echo $username_err; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label class="bmd-label-floating">Password</label>
                                    <input type="password" name="password" class="form-control" id="">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <button class="btn btn-primary pull-right" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</button>
                            <button class="btn btn-danger" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Signup</button>
                            <div class="clearfix"></div> -->
                        <!-- </form> -->
                        <!-- </div>
                    </div>
                    </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</body>
</html>