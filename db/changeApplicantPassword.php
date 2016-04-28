<?php
session_start();
require "./connect.php";

$id = $_SESSION["id"];

$newPassword = isset($_POST['newPasswordInput']) ? $_POST['newPasswordInput'] : '';
$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$sql = "
UPDATE `login`
SET `password`='$newPassword'
WHERE login_id=$id
";
//echo $sql;
mysqli_query($link, $sql);
mysqli_close($link);
header ("Location:../views/applicantloginpage.php")
?>
