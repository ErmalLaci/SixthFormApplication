<?php
require "../db/connect.php";
$table = "applicantlogin";

$username = isset($_POST['usernameapplicantlogin']) ? $_POST['usernameapplicantlogin'] : '';
$password = isset($_POST['passwordapplicantlogin']) ? $_POST['passwordapplicantlogin'] : '';

$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($link, $username);
$password = mysqli_real_escape_string($link,$password);

$sql = "SELECT * FROM $table WHERE BINARY username = '$username' AND BINARY password = '$password'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

if ($count == 1){

  $row = mysqli_fetch_array($result);

}else{
  //echo "$username";
  //echo "$password";
  //echo "test fail";
  header ("Location: ../views/loginfail.html");
}
