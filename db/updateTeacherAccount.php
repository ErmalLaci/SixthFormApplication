<?php
$error = "";
$id = isset($_POST['id']) ? $_POST['id'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$sname = isset($_POST['sname']) ? $_POST['sname'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$usernameChanged = isset($_POST['usernameChanged']) ? $_POST['usernameChanged'] : '';

require "./connect.php";

if ($usernameChanged == "true"){
  $sql = "
  SELECT login_id
  FROM login
  WHERE login_id = '$username'
  ";
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0){
    $error .= "Username already exists. ";
  }
}

if ($error == ""){
  $sql = "
  UPDATE login
  INNER JOIN teacher
  ON teacher.login_id = login.login_id
  SET
  username = '$username',
  password = '$password',
  fname = '$fname',
  sname = '$sname',
  department = '$department'
  WHERE login.login_id = '$id'
  ";
  //echo $sql;
  mysqli_query($link, $sql);
}

echo $error;
mysqli_close($link);
?>
