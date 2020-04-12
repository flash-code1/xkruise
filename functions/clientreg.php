<?php
include("connect.php");
?>

<?php
$digits = 6;
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$usertype = "client";
$status = "Not Active";

$res = mysqli_query($connection, "SELECT * FROM users");

if (count([$res]) == 1) {
    $x = mysqli_fetch_array($res);
    $ui = $x['username'];
    $ei = $x['password'];

    if ($username !== $ui || $email !== $ei) {
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
    } else {
        $_SESSION["Lack_of_intfund_$randms"] = "User Already Exists";
        echo header ("Location: ../login.php?message3=$randms");
    }
}
?>