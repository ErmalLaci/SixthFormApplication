<?php
$host = "localhost";
$sqlusername = "root";
$sqlpassword = "";
$db_name = "sixthformapplication";

$link = mysqli_connect($host, $sqlusername, $sqlpassword);
mysqli_select_db($link, $db_name);

?>
