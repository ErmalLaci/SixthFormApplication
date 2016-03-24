<?php

$username = substr("$fname",0,1) . $sname;
$length = 20;
$tutorAuthenticator = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);;
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);;

require "../db/connect.php";

$sql = "SELECT login_id FROM login WHERE BINARY username = '$username'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

if ($count > 0){
    $row = mysqli_fetch_assoc($result);
    $username = $username . strval($row["login_id"]);
}

//$email = isset($_POST["applyEmail"]) ? $_POST["applyEmail"] : "";
//$mobile = isset($_POST["applyMobile"]) ? $_POST["applyMobile"] : "";
//$tel = isset($_POST["applyTel"]) ? $_POST["applyTel"] : "";

$sql = "
INSERT INTO login (username, password, type)
VALUES ('$username', '$password', 'applicant')
";

mysqli_query($link, $sql) or die(mysql_error());

$sql = "SELECT login_id FROM login WHERE username = '$username'";

$result = mysqli_query($link, $sql) or die(mysql_error());

$row = mysqli_fetch_assoc($result);
$id = $row["login_id"];

$sql = "
INSERT INTO applicant (login_id, fname, sname)
VALUES ('$id', '$fname', '$sname')
";

mysqli_query($link, $sql) or die(mysql_error());

echo "account created";
?>
