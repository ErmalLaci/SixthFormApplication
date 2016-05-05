<?php

require "./connect.php";

$error = "";
$id = isset($_POST['id']) ? $_POST['id'] : '';  //get username, password, fName, sName, department and username changed input
$username = isset($_POST['username']) ? $_POST['username'] : '';
$username = stripslashes($username);
$username = mysqli_real_escape_string($link, $username);  //protect against sql injection
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = stripslashes($password);
$password = mysqli_real_escape_string($link, $password);  //protect against sql injection
$password = password_hash($password, PASSWORD_BCRYPT);
$fName = isset($_POST['fName']) ? $_POST['fName'] : '';
$fName = stripslashes($fName);
$fName = mysqli_real_escape_string($link, $fName);  //protect against sql injection
$sName = isset($_POST['sName']) ? $_POST['sName'] : '';
$sName = stripslashes($sName);
$sName = mysqli_real_escape_string($link, $sName);  //protect against sql injection
$department = isset($_POST['department']) ? $_POST['department'] : '';
$usernameChanged = isset($_POST['usernameChanged']) ? $_POST['usernameChanged'] : '';


if ($usernameChanged == "true"){  //check if username was changed
  $sql = "
  SELECT login_id
  FROM login
  WHERE username = '$username'
  ";
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0){  //if new username is taken store error
    $error .= "Username already exists. ";
  }
}

if ($error == ""){  //check there is no error
  $sql = "
  UPDATE login
  INNER JOIN teacher
  ON teacher.login_id = login.login_id
  SET
  username = '$username',
  password = '$password',
  fName = '$fName',
  sName = '$sName',
  department = '$department'
  WHERE login.login_id = '$id'
  ";
  //update teacher with new information
  mysqli_query($link, $sql);
}

echo $error;  //return error
mysqli_close($link);
?>
