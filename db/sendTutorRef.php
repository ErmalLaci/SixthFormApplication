<?php
require "./connect.php";
session_start();
$id = $_SESSION["studentid"]; //get id
session_destroy();
//get the value of all inputs from tutor reference form
$achievements = isset($_POST["studentsAchievements"]) ? $_POST["studentsAchievements"] : "";
$achievements = stripslashes($achievements);
$achievements = mysqli_real_escape_string($link, $achievements);  //protect against sql injection
$learningNeeds = $_POST["options-learningneeds"];
$learningNeedsDetails = isset($_POST["learningNeedsDetails"]) ? $_POST["learningNeedsDetails"] : "";
$learningNeedsDetails = stripslashes($learningNeedsDetails);
$learningNeedsDetails = mysqli_real_escape_string($link, $learningNeedsDetails);  //protect against sql injection
$learningSupport = $_POST["options-learningsupport"];
$learningSupportDetails = isset($_POST["learningSupportDetails"]) ? $_POST["learningSupportDetails"] : "";
$learningSupportDetails = stripslashes($learningSupportDetails);
$learningSupportDetails = mysqli_real_escape_string($link, $learningSupportDetails);  //protect against sql injection
$statemented = $_POST["options-statemented"];
$statementedDetails = isset($_POST["statementedDetails"]) ? $_POST["statementedDetails"] : "";
$statementedDetails = stripslashes($statementedDetails);
$statementedDetails = mysqli_real_escape_string($link, $statementedDetails);  //protect against sql injection
$specialConsideration = $_POST["options-specialconsideration"];
$specialConsiderationDetails = isset($_POST["specialConsiderationDetails"]) ? $_POST["specialConsiderationDetails"] : "";
$specialConsiderationDetails = stripslashes($specialConsiderationDetails);
$specialConsiderationDetails = mysqli_real_escape_string($link, $specialConsiderationDetails);  //protect against sql injection
$freeSchoolMeals = $_POST["options-freeschoolmeals"];
$tutorFirstName = isset($_POST["tutorFirstName"]) ? $_POST["tutorFirstName"] : "";
$tutorFirstName = stripslashes($tutorFirstName);
$tutorFirstName = mysqli_real_escape_string($link, $tutorFirstName);  //protect against sql injection
$tutorSurname = isset($_POST["tutorSurname"]) ? $_POST["tutorSurname"] : "";
$tutorSurname = stripslashes($tutorSurname);
$tutorSurname = mysqli_real_escape_string($link, $tutorSurname);  //protect against sql injection
$predictedOrActualGrades = $_POST["options-predictedoractualgrades"];

//sql for updating applicants information with tutor reference data
$sql = "
UPDATE applicant
SET studentachievements='$achievements', learningneeds='$learningNeeds', learningneedsdetails='$learningNeedsDetails', learningsupport='$learningSupport', learningsupportdetails='$learningSupportDetails', statemented='$statemented', statementeddetails='$statementedDetails', specialconsiderations='$specialConsideration', specialconsiderationsdetails='$specialConsiderationDetails', freeschoolmeals='$freeSchoolMeals', fnameoftutor='$tutorFirstName', snameoftutor='$tutorSurname', predictedoractualqualifications='$predictedOrActualGrades'
WHERE applicant_id='$id';
";

mysqli_query($link, $sql);
header ("Location: ../views/referencecomplete.html"); //go to reference complete page
mysqli_close($link);
?>
