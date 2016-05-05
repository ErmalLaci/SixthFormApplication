<?php
session_start();
require "./connect.php";
$authenticateTutor = isset($_POST['tutorAuthenticator']) ? $_POST['tutorAuthenticator'] : '';
$authenticateTutor = stripslashes($authenticateTutor);
$authenticateTutor = mysqli_real_escape_string($link, $authenticateTutor);  //protect against sql injection
$id = $_SESSION["studentid"];

//sql statement gets tutor authenticator if applicant id and tutor authenticator match
$sql = "
SELECT tutorauthenticator
FROM applicant
WHERE applicant_id = '$id' AND tutorauthenticator = '$authenticateTutor'
";

$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) == 0){  //check if any rows were selected
  echo "Error"; //if not there is an error
}

?>
