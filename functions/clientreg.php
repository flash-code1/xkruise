<?php
include("connect.php");
?>

<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$usertype = "client";
$status = "Not Active";

$qrys = "SELECT * FROM users WHERE username = '$username' && email = '$email'";
$res = mysqli_query($connection, $qrys);
$row = mysqli_fetch_array($res);
$ui = $row["username"];
$ei = $row["password"];

if ($ui == $username || $ei == $email) {
    $_SESSION["Lack_of_intfund_$randms"] = "Registration Failed";
    echo header ("Location: ../login.php?message2=$randms");
} else {
$queryuser = "INSERT INTO users (username, email, password, usertype, status)
VALUES ({$username}', '{$email}', '{$hash}', '{$usertype}', '{$status}')";

$result = mysqli_query($connection, $queryuser);
$_SESSION["Lack_of_intfund_$randms"] = "Registration Success";
echo header ("Location: ../login.php?message1=$randms");
if ($result) {

} else {
    $_SESSION["Lack_of_intfund_$randms"] = "Registration Failed";
   echo header ("Location: ../login.php?message2=$randms");
}
}
?>