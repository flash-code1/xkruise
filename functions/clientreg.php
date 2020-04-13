<?php
include("connect.php");
?>
<?php
include("../client.php");
?>
<?php
$digits = 6;
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password2'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$usertype = "client";
$status = "Not Active";

$res = mysqli_query($connection, "SELECT * FROM users");

if (count([$res]) == 1) {
    $x = mysqli_fetch_array($res);
    $ui = $x['username'];
    $ei = $x['email'];
// proper
    if ($username !== $ui && $email !== $ei) {
        $queryuser = "INSERT INTO users (username, email, password, usertype, status)
    VALUES ('{$username}', '{$email}', '{$hash}', '{$usertype}', '{$status}')";
    
    $result = mysqli_query($connection, $queryuser);
    if ($result) {
        echo '<script type="text/javascript">
    $(document).ready(function(){
        swal({
            type: "success",
            title: "Done",
            text: "Account Creation Successful",
            showConfirmButton: false,
            timer: 2000
        })
    });
    </script>
    ';
        echo header ("Location: ../login.php");
    } else {
        echo '<script type="text/javascript">
    $(document).ready(function(){
        swal({
            type: "error",
            title: "Error",
            text: "Account Creation Error",
            showConfirmButton: false,
            timer: 2000
        })
    });
    </script>
    ';
        echo header ("Location: ../login.php");
    }
    } else {
        echo '<script type="text/javascript">
    $(document).ready(function(){
        swal({
            type: "error",
            title: "Existing Account",
            text: "Account Has Been Created",
            showConfirmButton: false,
            timer: 2000
        })
    });
    </script>
    ';
        echo header ("Location: ../login.php");
    }
}
?>