<?php
session_start();
require "../db/connect.php";
$tbl_name = "login";
$_SESSION["id"] = "";
$_SESSION["username"] = isset($_POST["usernamelogin"]) ? $_POST["usernamelogin"] : "";
$password = isset($_POST["passwordlogin"]) ? $_POST["passwordlogin"] : "";
$_SESSION["username"] = stripslashes($_SESSION["username"]);
$password = stripslashes($password);
$_SESSION["username"] = mysqli_real_escape_string($link, $_SESSION["username"]);
$password = mysqli_real_escape_string($link,$password);
$username = $_SESSION["username"];
$sql = "
SELECT *
FROM $tbl_name
WHERE BINARY username = '$username' AND BINARY password = '$password'
";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
$_SESSION["connected"] = false;
$_SESSION["type"] = "";
if ($count == 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION["id"] = $row["login_id"];
    $_SESSION["type"] = $row["type"];
    $_SESSION["connected"] = true;
    if ($row["type"] == "admin"){
        header ("Location: ../views/adminloginpage.php");
    } elseif ($row["type"] == "applicant"){
        header ("Location: ../views/applicantloginpage.php");
    } else {
        header ("Location: ../views/teacherloginpage.php");
    }
}else{
    header ("Location: ../views/loginfail.html");
}
?>
