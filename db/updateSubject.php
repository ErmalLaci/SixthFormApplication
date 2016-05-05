<?php
$tblName = "subject";
require "./connect.php";

//Get the name of the option the user wants to remove
$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$name = stripslashes($name);
$name = mysqli_real_escape_string($link, $name);  //protect against sql injection
$examBoard = isset($_POST['examBoard']) ? $_POST['examBoard'] : '';

//SQL to update subject
$sql ="
UPDATE $tblName
SET
name = '$name',
exam_board = '$examBoard'
WHERE `subject_id` = '$id'
";

mysqli_query($link, $sql) or die(mysqli_error($link));
mysqli_close($link);

?>
