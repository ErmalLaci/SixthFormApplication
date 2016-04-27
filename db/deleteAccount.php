<?php
require "./connect.php";

$id = $_POST["id"];

$sql = "
DELETE FROM login
WHERE login_id='$id'
";
echo $sql;
mysqli_query($link, $sql) or die(mysqli_error($link));

mysqli_close($link);
?>
