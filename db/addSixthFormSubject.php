<?php
$tbl_name = "sixth form subject";

//Connect to the server
require "./connect.php";

//Gets the values in the form
$addSixthFormSubjectName = isset($_POST['addSixthFormSubjectName']) ? $_POST['addSixthFormSubjectName'] : '';
$addSixthFormSubjectLevel = $_POST['addSixthFormSubjectLevel'];
$addSixthFormSubjectBlock = $_POST['addSixthFormSubjectBlock'];

if ($addSixthFormSubjectLevel == "A Level"){
  $sql = "
  INSERT INTO `$tbl_name` (`name`, `level`, `block`)
  VALUES ('$addSixthFormSubjectName', '$addSixthFormSubjectLevel', '$addSixthFormSubjectBlock')
  ";
} else {
  $sql = "
  INSERT INTO `$tbl_name` (`name`, `level`, `block`)
  VALUES ('$addSixthFormSubjectName', '$addSixthFormSubjectLevel', NULL)
  ";
}
//echo $sql;
mysqli_query($link, $sql) or die(mysqli_error($link));

//Go back to edit form page after editing table
mysqli_close($link);
header ("Location: ../views/admineditform.php");

?>
