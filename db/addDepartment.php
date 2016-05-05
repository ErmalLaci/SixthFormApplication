<?php

require "./connect.php";  //connect to the server

$allDepartments = [];
$newDepartment = isset($_POST['department']) ? $_POST['department'] : '';
$newDepartment = stripslashes($newDepartment);
$newDepartment = mysqli_real_escape_string($link, $newDepartment);  //protect against sql injection
$allDepartments = isset($_POST['departmentJson']) ? json_decode($_POST['departmentJson']) : '';

//sql to alter column
$sql = "
ALTER TABLE teacher
MODIFY COLUMN department enum(
";
for ($i = 0; $i < count($allDepartments); $i++){  //loop through all departments so all previous departments are kept
  $sql.= "'$allDepartments[$i]', ";
}
$sql .= "'$newDepartment')";  //add new department at the end

mysqli_query($link, $sql);
mysqli_close($link);
?>
