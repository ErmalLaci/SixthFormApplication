<?php

$alldepartments = [];
$newdepartment = isset($_POST['department']) ? $_POST['department'] : '';
$alldepartments = isset($_POST['departmentjson']) ? json_decode($_POST['departmentjson']) : '';

require "./connect.php";

$sql = "
ALTER TABLE teacher
MODIFY COLUMN department enum(
";
for ($i = 0; $i < count($alldepartments); $i++){
  $sql.= "'$alldepartments[$i]', ";
}
$sql .= "'$newdepartment')";

echo $sql;

mysqli_query($link, $sql);
mysqli_close($link);
?>
