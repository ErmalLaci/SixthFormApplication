<?php
require "./connect.php";

$id = isset($_POST["id"]) ? $_POST["id"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$display = "";

if ($username == ""){
    $sql = "
    SELECT login_id, username, type
    FROM `login`
    WHERE login_id='$id'
    ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["login_id"] != ""){
        echo $row["login_id"] . ",";
        echo $row["username"] . ",";
        echo $row["type"];
    } else {
        echo " ,There is no user with this id,";
    }
} elseif ($id == ""){
    $sql = "
    SELECT *
    FROM `login`
    WHERE username='$username'
    ";
    $result = mysqli_query($link, $sql) or die(mysql_error());
    $row = mysqli_fetch_assoc($result);
    echo $row["login_id"] . ",";
    echo $row["username"] . ",";
    echo $row["type"];
} else {
    $sql = "
    SELECT *
    FROM `login`
    WHERE username='$username'
    ";
    $result = mysqli_query($link, $sql) or die(mysql_error());
    $row = mysqli_fetch_assoc($result);
    echo $row["login_id"] . ",";
    echo $row["username"] . ",";
    echo $row["type"];
    if ($row["login_id"] != $id){
        $display += "The id and username you input do not match, the results for the username you queried are shown.";
    }
}
?>