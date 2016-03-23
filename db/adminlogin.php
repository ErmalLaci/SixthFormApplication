<?php
session_start();
  require "../db/connect.php";
  $tbl_name = "admin";
  $_SESSION["id"] = "";
  $_SESSION["username"] = isset($_POST["usernameadminlogin"]) ? $_POST["usernameadminlogin"] : "";
  $_SESSION["password"] = isset($_POST["passwordadminlogin"]) ? $_POST["passwordadminlogin"] : "";
  $_SESSION["username"] = stripslashes($_SESSION["username"]);
  $_SESSION["password"] = stripslashes($_SESSION["password"]);
  $_SESSION["username"] = mysqli_real_escape_string($link, $_SESSION["username"]);
  $_SESSION["password"] = mysqli_real_escape_string($link,$_SESSION["password"]);
  $username = $_SESSION["username"];
  $password = $_SESSION["password"];
  $sql = "SELECT * FROM $tbl_name WHERE BINARY username = '$username' AND BINARY password = '$password'";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);
  $_SESSION["connected"] = false;
  if ($count == 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION["id"] = $row["adminid"];
    $_SESSION["connected"] = true;
    header ("Location: ../views/adminloginpage.php");
  }else{
    //echo "$_SESSION["username"]";
    //echo "$_SESSION["password"]";
    //echo "test fail";
    header ("Location: ../views/loginfail.html");
  }
?>
