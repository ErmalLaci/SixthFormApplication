<?php
require "./connect.php";

$id = $_POST["id"]; //get id

//sql to delete row from login, no need for separate sql statement to delete teacher as it cascades
$sql = "
DELETE FROM login
WHERE login_id='$id'
";

mysqli_query($link, $sql) or die(mysqli_error($link));

mysqli_close($link);
?>
