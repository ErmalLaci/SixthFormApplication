<?php
session_start();
require "../db/connect.php";
$response = "";
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
WHERE BINARY username = '$username'
";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
$_SESSION["type"] = "";

if ($count == 1){
    $row = mysqli_fetch_assoc($result);
	  if (password_verify($password, $row['password'])) {
				//Password matches, so create the session
      $_SESSION["id"] = $row["login_id"];
      $_SESSION["type"] = $row["type"];

      if ($row["type"] == "admin"){
        //header ("Location: ../views/adminloginpage.php");
        $response = "admin";
      } elseif ($row["type"] == "applicant"){
        //header ("Location: ../views/applicantloginpage.php");
        $response = "applicant";
      } else {
        //header ("Location: ../views/teacherloginpage.php");
        $response = "teacher";
      }
    } else {
      //header ("Location: ../views/loginfail.html");
      $response = "fail";
    }
}else{
    //header ("Location: ../views/loginfail.html");
    $response = "fail";
}
mysqli_close($link);

echo $response;

?>
