<?php

require "./connect.php";  //connect to the server

$username = isset($_POST['username']) ? $_POST['username'] : '';  //get input data
$username = stripslashes($username);
$username = mysqli_real_escape_string($link, $username);  //protect against sql injection
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = stripslashes($password);
$password = mysqli_real_escape_string($link, $password);  //protect against sql injection
$password = password_hash($password, PASSWORD_BCRYPT);  //encrypt the password

$fName = isset($_POST['fName']) ? $_POST['fName'] : '';
$sName = isset($_POST['sName']) ? $_POST['sName'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';

//sql selects all users with this login id
$sql = "
SELECT `login_id`
FROM `login`
WHERE `username`='$username'
";

$result = mysqli_query($link, $sql) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0){  //check any rows are selected
  echo "This username is taken. ";
} else {
  //if there is no error insert user into login table
  $sql = "
  INSERT INTO `login`(`username`, `password`, `type`)
  VALUES ('$username', '$password', 'teacher')
  ";

  $result = mysqli_query($link, $sql) or die(mysqli_error($link));
  $lastid = mysqli_insert_id($link);  //get login id of teacher

  //insert teacher information into teacher table
  $sql = "
  INSERT INTO `teacher` (`fname`, `sname`, `department`, `login_id`)
  VALUES ('$fName', '$sName', '$department', '$lastid')
  ";

  mysqli_query($link, $sql) or die(mysqli_error($link));

}

mysqli_close($link);
?>
