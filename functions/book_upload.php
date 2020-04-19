<?php
include("connect.php");
session_start();

?>
<?php
$c_id = $_SESSION["id"];
$user = $_SESSION["username"];
$email = $_SESSION["email"];
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];
$location = $_POST['location'];
$car_id = $_POST['car_id'];
$ext_ride = $_POST['ext_ride'];
if ($ext_ride == 0 || $ext_ride == "0") {
    $amount = 3000 * 1;
} else if ($ext_ride == 1 || $ext_ride == "1") {
    $amount = 3000 * 2;
} else if ($ext_ride == 2 || $ext_ride == "2") {
    $amount = 3000 * 3;
} else if ($ext_ride == 3 || $ext_ride == "3") {
    $amount = 3000 * 4;
} else {
    $amount = 3000;
}
$pm = $_POST['pm'];
$locate = $_POST['location'];
$digits = 6;
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$reference = $randms;

$getd = "SELECT * FROM `users` WHERE usertype = 'driver' && status = 'Active' ORDER BY RAND() LIMIT 1";
$res = mysqli_query($connection, $getd);
$row = mysqli_fetch_array($res);
$di = $row["id"];
$dun = $row["username"];
// address
$locality = $row["locality"];
$city = $row["city"];
$post_code = $row["postal_code"];
$land_mark = $row["landmark"];
$state = $row["state"];

// later on for lng and lat

$getdd = "SELECT * FROM `fleet_management` WHERE id = '$car_id' && status = 'Good'";
$res = mysqli_query($connection, $getdd);
$rowx = mysqli_fetch_array($res);
$plate_no = $rowx["plate_number"];

$stat = "Pending";

if ($dun == "" || $dun == NULL) {
 $dun = "Pending";
}
if($pm == "card") {
    $stat = "Paid";
    // if it is card confirm payment and save into booking and aslo Account Transaction
    $csql = "INSERT INTO `booking` (`id`, `client_id`, `client_name`, `car_id`, `pickup_date`, `pickup_time`, `ext_ride`, `payment_method`, `status`, `amount`, `location`, `plate_number`, `driver_id`, `driver_name`,
    `locality`, `city`, `postal_code`, `land_mark`, `state`) 
    VALUES ('{$reference}', '{$c_id}', '{$user}', '{$car_id}', '{$pickup_date}',
    '{$pickup_time}', '{$ext_ride}', '{$pm}', '{$stat}', '{$amount}', '{$locate}', '{$plate_no}', '{$di}', '{$dun}',
    '{$locate}', '{$city}', '{$post_code}', '{$land_mark}', '{$state}')";
    $res2 = mysqli_query($connection, $csql);
    if ($res2) {
        $_SESSION["Lack_of_intfund_$randms"] = "Oder Successful";
   echo header ("Location: ../book.php?message1=$randms");
    } else {
        $_SESSION["Lack_of_intfund_$randms"] = "Oder Failed";
   echo header ("Location: ../book.php?message2=$randms");
    }
} else if ($pm == "cash") {
    $stat = "Pending";
    $csql = "INSERT INTO `booking` (`id`, `client_id`, `client_name`, `car_id`, `pickup_date`, `pickup_time`, `ext_ride`, `payment_method`, `status`, `amount`, `location`, `plate_number`, `driver_id`, `driver_name`,
    `locality`, `city`, `postal_code`, `land_mark`, `state`) 
    VALUES ('{$reference}', '{$c_id}', '{$user}', '{$car_id}', '{$pickup_date}',
    '{$pickup_time}', '{$ext_ride}', '{$pm}', '{$stat}', '{$amount}', '{$locate}', '{$plate_no}', '{$di}', '{$dun}',
    '{$locate}', '{$city}', '{$post_code}', '{$land_mark}', '{$state}')";
    $res2 = mysqli_query($connection, $csql);
    if ($res2) {
        $_SESSION["Lack_of_intfund_$randms"] = "Oder Successful";
   echo header ("Location: ../book.php?message1=$randms");
    } else {
        $_SESSION["Lack_of_intfund_$randms"] = "Oder Failed";
   echo header ("Location: ../book.php?message2=$randms");
    }
} else {
        $_SESSION["Lack_of_intfund_$randms"] = "Select Payment Option";
   echo header ("Location: ../book.php?message3=$randms");
}

?>