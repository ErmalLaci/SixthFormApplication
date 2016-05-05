<?php
$tblName = "sixth form subject";

require "./connect.php";

//Get the id of the subject the user wants to update
$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$name = stripslashes($name);
$name = mysqli_real_escape_string($link, $name);  //protect against sql injection
$level = $_POST['level'];
$block = $_POST['block'];
echo $level;
if ($level == "A Level"){  //check if the level is 'A level'
  $sql = "
  UPDATE `$tblName`
  SET
  name = '$name',
  level = '$level',
  block = '$block'
  WHERE `sixthformsubject_id` = '$id'
  ";
} else {  //check if the level is 'level 2'
  $sql ="
  UPDATE `$tblName`
  SET
  name = '$name',
  level = '$level',
  block = NULL
  WHERE `sixthformsubject_id` = '$id'
  ";  //block is NULL if level is level 2
}
//sql updates sixth form subject
mysqli_query($link, $sql) or die(mysqli_error($link));
mysqli_close($link);
 ?>
