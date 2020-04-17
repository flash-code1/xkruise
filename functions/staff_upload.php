<?php
include("connect.php");
?>

<?php
$digits = 6;
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$acctno = "2X00".$randms;
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$usertype = "staff";
$status = "Not Active";
session_start();
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
        $res2 = mysqli_query($connection, "SELECT * FROM users WHERE username ='$username'");
if (count([$res2]) == 1) {
    $x = mysqli_fetch_array($res2);
    $uid = $x['id'];
    $amt = 0;
    $acct = "INSERT INTO account (user_id, account_no, amount)
    VALUES ('{$uid}', '{$acctno}', '{$amt}')";
    $res3 = mysqli_query($connection, $acct);
    if ($res3) {
        $_SESSION["Lack_of_intfund_$randms"] = "Registration Suc";
         echo header ("Location: ../ERP/user.php?message1=$randms");
    } else {
        echo header ("Location: ../ERP/user.php?message1=$randms");
    }
}
    } else {
        $_SESSION["Lack_of_intfund_$randms"] = "Registration Failed";
        echo header ("Location: ../ERP/user.php?message2=$randms");
    }
    } else {
        $_SESSION["Lack_of_intfund_$randms"] = "Registration Ex";
   echo header ("Location: ../ERP/user.php?message3=$randms");
    }
}
?>