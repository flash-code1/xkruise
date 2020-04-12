<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  if($_SESSION["usertype"] == "client"){
    header("location: book.php");
    exit;
  } 
  elseif($_SESSION["usertype"] == "admin"){
    header("location: ERP/index.php");
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
        $username_err = "Please enter Username.";
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
        $sql = "SELECT id, username, email, usertype, password FROM users WHERE users.username = ?";
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
                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $usertype, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            session_regenerate_id();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            $_SESSION["usertype"] = $usertype;
                            // $_SESSION["lastname"] = $lastname;
                            session_write_close();                            
                            //run a quick code to show active user
                            // Redirect user to welcome page
                            if ($stmt->num_rows ==1 && $_SESSION["usertype"] =="client") {
                              header("location: book.php");
                            }elseif ($stmt->num_rows ==1 && $_SESSION["usertype"]=="admin"){
                                header("location: ERP/index.php");
                            //   header("location: ./mfi/admin/dashboard.php");
                            }
                            elseif ($stmt->num_rows ==1 && $_SESSION["usertype"]=="staff") {
                                if($_SESSION["employee_status"] == "Employed"){
                                    header("location: ERP/index.php");
                                  }
                                  elseif($_SESSION["employee_status"] == "Decommisioned"){
                                    $err = "Sorry You cannot login";
                                    $password = "";
                                  }
                            }
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that Username.";
                }
            } else{
                $username_err = "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
    }
    
    // Close connection
    mysqli_close($link);
    mysqli_stmt_close($stmt);
}

include('functions/config.php');

?>

<?php
if (isset($_GET["message1"])) {
    $key = $_GET["message1"];
    // $out = $_SESSION["lack_of_intfund_$key"];
    $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
    $outx = "Account Successfully Created";
    $_SESSION["lack_of_intfund_$key"] = 0;
 }
} else if (isset($_GET["message2"])) {
    $key = $_GET["message2"];
    // $out = $_SESSION["lack_of_intfund_$key"];
    $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
    $outxx = "Account Creation Failed";
    $_SESSION["lack_of_intfund_$key"] = 0;
  }
}
else if (isset($_GET["message3"])) {
    $key = $_GET["message3"];
    // $out = $_SESSION["lack_of_intfund_$key"];
    $tt = 0;
  if ($tt !== $_SESSION["lack_of_intfund_$key"]) {
    $outxxx = "This Account Username or Password Exist Already";
    $_SESSION["lack_of_intfund_$key"] = 0;
  }
}
$outx = "";
$outxx = "";
$outxxx = "";
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="assetsk/css/login-register.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
                                      <div><?php echo $outx.$outxx.$outxx;?></div>
                                    <div class="line r"></div>
                                </div>
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <div><?php echo $err;?></div>
                                    <form method="post" accept-charset="UTF-8">
                                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                    <input id="email" class="form-control" type="text" placeholder="Username" name="username">
                                    <span class="help-block"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                    </div>
                                    <input class="btn btn-default btn-login" type="submit" name="Login" value="Login">
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <form action="functions/clientreg.php" method="post">
                                <input id="email" class="form-control" type="text" type="email" placeholder="Email" name="email">
                                <input id="username" class="form-control" type="text" placeholder="Username" name="username">
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password2">
                                <!-- <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation"> -->
                                <input class="btn btn-default btn-register" type="submit" name="Signup" value="Signup" name="Signup">
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
            </div>
        </div>
    </div>
</body>
</html>