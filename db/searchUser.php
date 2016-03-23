<?php
require "./connect.php";

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$display = "";

if ($username == ""){
    $sql = "
    SELECT *
    FROM `login`
    WHERE login_id='$id'
    ";
    $result = mysqli_query($link, $sql) or die(mysql_error())
    $row = mysqli_fetch_assoc($result);
    $display += $row["login_id"] . ",";
    $display += $row["username"] . ",";
    $display += $row["password"] . ",";
    $display += $row["type"] . ",";
} elseif ($id == ""){
    $sql = "
    SELECT *
    FROM `login`
    WHERE username='$username'
    ";
    $result = mysqli_query($link, $sql) or die(mysql_error())
    $row = mysqli_fetch_assoc($result);
    $display += $row["login_id"] . ",";
    $display += $row["username"] . ",";
    $display += $row["password"] . ",";
    $display += $row["type"] . ",";
} else {
    $sql = "
    SELECT *
    FROM `login`
    WHERE username='$username'
    ";
    $result = mysqli_query($link, $sql) or die(mysql_error())
    $row = mysqli_fetch_assoc($result);
    $display += $row["login_id"] . ",";
    $display += $row["username"] . ",";
    $display += $row["password"] . ",";
    $display += $row["type"] . ",";
    if ($row["login_id"] != $id){
        $display += "The id you input does not match the username, the results for the username you queried are shown.";
    }
}
echo $display;
?>