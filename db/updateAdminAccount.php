<?php
$error = "";
$id = isset($_POST['id']) ? $_POST['id'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = password_hash($password, PASSWORD_BCRYPT);
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
  SET
  username = '$username',
  password = '$password'
  WHERE login_id = '$id'
  ";
  //echo $sql;
  mysqli_query($link, $sql);
}

echo $error;
mysqli_close($link);
?>
