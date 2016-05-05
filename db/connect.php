<?php
$host = "localhost";
$sqlusername = "root";
$sqlpassword = "";
$db_name = "sixthformapplication";

$link = mysqli_connect($host, $sqlusername, $sqlpassword);  //connect to the server
mysqli_select_db($link, $db_name);  //connect to the database

?>
