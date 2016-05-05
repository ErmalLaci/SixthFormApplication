<?php
session_start();
require "../db/connect.php";
$response = "";
$tblName = "login";
$_SESSION["id"] = "";
$_SESSION["username"] = isset($_POST["usernameLogin"]) ? $_POST["usernameLogin"] : "";
$password = isset($_POST["passwordLogin"]) ? $_POST["passwordLogin"] : "";
$_SESSION["username"] = stripslashes($_SESSION["username"]);
$password = stripslashes($password);
$_SESSION["username"] = mysqli_real_escape_string($link, $_SESSION["username"]);
$password = mysqli_real_escape_string($link,$password); //protect against sql injection
$username = $_SESSION["username"];

//search for account matching username input
$sql = "
SELECT *
FROM $tblName
WHERE BINARY username = '$username'
";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
$_SESSION["type"] = "";

if ($count == 1){ //check if the input username was valid
    $row = mysqli_fetch_assoc($result);
	  if (password_verify($password, $row['password'])) {  //check if password matches username
				//Password matches, so create the session
      $_SESSION["id"] = $row["login_id"];
      $_SESSION["type"] = $row["type"];
      if ($row["type"] == "admin"){
        $response = "admin";  //if resonse is teacher then user will be sent to admin login page
      } elseif ($row["type"] == "applicant"){
        $response = "applicant";  //if resonse is teacher then user will be sent to applicant login page
      } else {
        $response = "teacher";  //if resonse is teacher then user will be sent to teacher login page
      }
    } else {
      $response = "fail"; //if response is fail then error will de displayed
    }
}else{
    $response = "fail"; //if response is fail then error will de displayed
}
mysqli_close($link);

echo $response;

?>
