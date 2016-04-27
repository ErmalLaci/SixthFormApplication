<?php
$tbl_name = "subject";

//Connect to the server
require "./connect.php";

//Gets the values in the form
$addSubjectName = isset($_POST['addSubjectName']) ? $_POST['addSubjectName'] : '';
$addSubjectExamboard = isset($_POST['addSubjectExamboard']) ? $_POST['addSubjectExamboard'] : '';

$sql = "
INSERT INTO `$tbl_name` (`name`, `exam_board`)
VALUES ('$addSubjectName', '$addSubjectExamboard')
";
//echo $sql;
mysqli_query($link, $sql) or die(mysqli_error($link));

//Go back to edit form page after editing table
mysqli_close($link);
header ("Location: ../views/admineditform.php");

?>
