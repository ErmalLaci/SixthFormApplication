<?php
require "./connect.php";

$error = "";
$id = isset($_POST['id']) ? $_POST['id'] : '';
$id = stripslashes($id);
$id = mysqli_real_escape_string($link, $id);  //protect against sql injection
$username = isset($_POST['username']) ? $_POST['username'] : '';
$username = stripslashes($username);
$username = mysqli_real_escape_string($link, $username);  //protect against sql injection
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = stripslashes($password);
$password = mysqli_real_escape_string($link, $password);  //protect against sql injection
$password = password_hash($password, PASSWORD_BCRYPT);  //encrypt password
$usernameChanged = isset($_POST['usernameChanged']) ? $_POST['usernameChanged'] : '';

if ($usernameChanged == "true"){  //check if username was changed
  //select login id where the username has been taken
  $sql = "
  SELECT login_id
  FROM login
  WHERE username = '$username'
  ";
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0){  //check if username has been taken
    $error .= "Username already exists. ";
  }
}

if ($error == ""){  //check if there is an error
  $sql = "
  UPDATE login
  SET
  username = '$username',
  password = '$password'
  WHERE login_id = '$id'
  ";
  mysqli_query($link, $sql);  //update the admin account with the new username and password
}

echo $error;  //return error
mysqli_close($link);
?>
