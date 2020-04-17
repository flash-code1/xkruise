<?php
include("connect.php");
?>

<?php
$brand = $_POST['brand'];
$name = $_POST['name'];
$plate_number = $_POST['plate_number'];
$amount = $_POST['amount'];
$status = $_POST['stat'];
$res = mysqli_query($connection, "SELECT * FROM fleet_management");

$digits = 10;
$temp = explode(".", $_FILES['car_img']['name']);
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$imagex = $randms. '.' .end($temp);

if (move_uploaded_file($_FILES['car_img']['tmp_name'], "Fleet/" . $imagex)) {
    $msg = "Image uploaded successfully";
} else {
  $msg = "Image Failed";
}
$digits = 10;
$temp = explode(".", $_FILES['document']['name']);
$randms = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$imagex1 = $randms. '.' .end($temp);

if (move_uploaded_file($_FILES['document']['tmp_name'], "Fleet/" . $imagex1)) {
    $msg = "Image uploaded successfully";
} else {
  $msg = "Image Failed";
}

if (count([$res]) == 1) {
    $x = mysqli_fetch_array($res);
    $pt = $x['plate_number'];
// proper
    if ($plate_number !== $pt) {
    $queryuser = "INSERT INTO fleet_management (name, brand, status, plate_number, document, car_img, amount)
    VALUES ('{$name}', '{$brand}', '{$status}', '{$plate_number}', '{$imagex1}', '{$imagex}', '{$amount}')";
    
    $result = mysqli_query($connection, $queryuser);
    if ($result) {
       
        $_SESSION["Lack_of_intfund_$randms"] = "Registration Suc";
         echo header ("Location: ../ERP/fleet_management.php?message1=$randms");
} else {
        $_SESSION["Lack_of_intfund_$randms"] = "Registration Failed";
        echo header ("Location: ../ERP/fleet_management.php?message2=$randms");
    }
} else {
    $_SESSION["Lack_of_intfund_$randms"] = "Registration Ex";
echo header ("Location: ../ERP/fleet_management.php?message3=$randms");
}
}
?>