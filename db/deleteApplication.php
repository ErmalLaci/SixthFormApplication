<?php

$id = isset($_POST["applicant_id"]) ? $_POST["applicant_id"] : "";

require "./connect.php";

$sql = "
DELETE login
FROM login
INNER JOIN applicant
ON `applicant`.login_id = `login`.login_id
WHERE applicant_id = $id
";

echo $sql;

mysqli_query($link, $sql) or die(mysqli_error($link));

mysqli_close($link);
?>
