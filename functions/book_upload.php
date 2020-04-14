<?php
include("connect.php");
session_start();

?>
<?php
$ssint_id = $_SESSION["id"];
$user = $_SESSION["username"];
$email = $_SESSION["email"];
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];
$location = $_POST['location'];
$car_id = $_POST['car_id'];
$ext_ride = $_POST['ext_ride'];
$pm = $_POST['pm'];
$locate = $_POST['location'];
$digits = 10;
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$reference = $randms;

$amount = 3000 * $ext_ride;
if($pm == "card") {
} else {

}

?>