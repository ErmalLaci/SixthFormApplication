<?php

//Connect to the server
require "./connect.php";

//Gets the values in the form
$addSubjectName = isset($_POST['addSubjectName']) ? $_POST['addSubjectName'] : '';
$addSubjectName = stripslashes($addSubjectName);
$addSubjectName = mysqli_real_escape_string($link, $addSubjectName);  //protect against sql injection
$addSubjectExamboard = isset($_POST['addSubjectExamboard']) ? $_POST['addSubjectExamboard'] : '';
$addSubjectExamboard = stripslashes($addSubjectExamboard);
$addSubjectExamboard = mysqli_real_escape_string($link, $addSubjectExamboard);  //protect against sql injection
$addSubjectName = strtoupper($addSubjectName);  //protect against sql injection
$addSubjectExamboard = strtoupper($addSubjectExamboard);  //protect against sql injection

//sql for adding subject
$sql = "
INSERT INTO `subject` (`name`, `exam_board`)
VALUES ('$addSubjectName', '$addSubjectExamboard')
";
//echo $sql;
mysqli_query($link, $sql) or die(mysqli_error($link));

//Go back to edit form page after editing table
mysqli_close($link);
header ("Location: ../views/admineditform.php");

?>
