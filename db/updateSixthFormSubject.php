<?php
$tbl_name = "sixth form subject";

require "./connect.php";

//Get the name of the option the user wants to remove
$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$level = $_POST['level'];
$block = $_POST['block'];

if ($level = "A Level"){
  $sql ="
  UPDATE `$tbl_name`
  SET
  name = '$name',
  level = '$level',
  block = '$block'
  WHERE `sixthformsubject_id` = '$id'
  ";
} else {
  $sql ="
  UPDATE `$tbl_name`
  SET
  name = '$name',
  level = '$level',
  block = NULL
  WHERE `sixthformsubject_id` = '$id'
  ";
}

echo $sql;

mysqli_query($link, $sql) or die(mysqli_error($link));

mysqli_close($link);
 ?>
