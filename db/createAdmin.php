<?php

require "./connect.php";  //connect to the server
$username = isset($_POST['username']) ? $_POST['username'] : '';  //get input username and password
$username = stripslashes($username);
$username = mysqli_real_escape_string($link, $username);  //protect against sql injection
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = stripslashes($password);
$password = mysqli_real_escape_string($link, $password);  //protect against sql injection
$password = password_hash($password, PASSWORD_BCRYPT);  //encrypt password

//sql selects all users with this login id
$sql = "
SELECT login_id
FROM login
WHERE username='$username'
";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0){  //check any rows are selected
  echo "This username is taken. ";  //display error
} else {
  //if there is no error insert user into login table
  $sql = "
  INSERT INTO `login`(`username`, `password`, `type`)
  VALUES ('$username', '$password', 'admin')
  ";

  mysqli_query($link, $sql) or die(mysqli_error($link));
}
mysqli_close($link);
?>
