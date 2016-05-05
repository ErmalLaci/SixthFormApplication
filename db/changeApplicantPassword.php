<?php
session_start();
require "./connect.php";  //connect to the server

$id = $_SESSION["id"];  //get id of current user

$newPassword = isset($_POST['newPasswordInput']) ? $_POST['newPasswordInput'] : ''; //get value of new password
$newPassword = stripslashes($newPassword);
$newPassword = mysqli_real_escape_string($link, $newPassword);  //protect against sql injection
$newPassword = password_hash($newPassword, PASSWORD_DEFAULT); //encrypt password
//update account with new encrypted password
$sql = "
UPDATE `login`
SET `password`='$newPassword'
WHERE login_id=$id
";
mysqli_query($link, $sql);
mysqli_close($link);
header ("Location:../views/applicantloginpage.php")
?>
