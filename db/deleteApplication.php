<?php

$id = isset($_POST["applicantId"]) ? $_POST["applicantId"] : "";  //get applicant id

require "./connect.php";  //connect to the server

//sql to delete applicant from login table joins as php only gets the applicant id, no need to delete any other information as all tables linked cascade on delete
$sql = "
DELETE login
FROM login
INNER JOIN applicant
ON `applicant`.login_id = `login`.login_id
WHERE applicant_id = $id
";

mysqli_query($link, $sql) or die(mysqli_error($link));

mysqli_close($link);
?>
