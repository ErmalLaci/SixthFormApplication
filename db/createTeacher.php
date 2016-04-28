<?php

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = password_hash($password, PASSWORD_BCRYPT);
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$sname = isset($_POST['sname']) ? $_POST['sname'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';

require "./connect.php";

$sql = "
SELECT `login_id`
FROM `login`
WHERE `username`='$username'
";

$result = mysqli_query($link, $sql) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0){
  echo "This username is taken. ";
} else {

  $sql = "
  INSERT INTO `login`(`username`, `password`, `type`)
  VALUES ('$username', '$password', 'teacher')
  ";

  $result = mysqli_query($link, $sql) or die(mysqli_error($link));
  $lastid = mysqli_insert_id($link);

  $sql = "
  INSERT INTO `teacher` (`fname`, `sname`, `department`, `login_id`)
  VALUES ('$fname', '$sname', '$department', '$lastid')
  ";

  mysqli_query($link, $sql) or die(mysqli_error($link));

}

mysqli_close($link);
?>
