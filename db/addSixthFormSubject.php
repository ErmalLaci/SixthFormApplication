<?php
$tblName = "sixth form subject";

//Connect to the server
require "./connect.php";

//Gets the values in the form
$addSixthFormSubjectName = isset($_POST['addSixthFormSubjectName']) ? $_POST['addSixthFormSubjectName'] : '';
$addSixthFormSubjectName = stripslashes($addSixthFormSubjectName);
$addSixthFormSubjectName = mysqli_real_escape_string($link, $addSixthFormSubjectName);  //protect against sql injection
$addSixthFormSubjectLevel = $_POST['addSixthFormSubjectLevel'];
$addSixthFormSubjectBlock = $_POST['addSixthFormSubjectBlock'];

if ($addSixthFormSubjectLevel == "A Level"){  //checks if subject level is a level
  //sql for a level subject has a value for block
  $sql = "
  INSERT INTO `$tblName` (`name`, `level`, `block`)
  VALUES ('$addSixthFormSubjectName', '$addSixthFormSubjectLevel', '$addSixthFormSubjectBlock')
  ";
} else {
  //sql for levle 2 subject gives block null value
  $sql = "
  INSERT INTO `$tblName` (`name`, `level`, `block`)
  VALUES ('$addSixthFormSubjectName', '$addSixthFormSubjectLevel', NULL)
  ";
}
mysqli_query($link, $sql) or die(mysqli_error($link));

//Go back to edit form page after editing table
mysqli_close($link);
header ("Location: ../views/admineditform.php");

?>
