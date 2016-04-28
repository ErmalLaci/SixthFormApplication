<?php

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = password_hash($password, PASSWORD_BCRYPT);
require "./connect.php";

$sql = "
SELECT login_id
FROM login
WHERE username='$username'
";

//echo $sql;
$result = mysqli_query($link, $sql) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0){
  echo "This username is taken. ";
} else {

  $sql = "
  INSERT INTO `login`(`username`, `password`, `type`)
  VALUES ('$username', '$password', 'admin')
  ";

  //echo $sql;
  mysqli_query($link, $sql) or die(mysqli_error($link));
}
mysqli_close($link);
?>
