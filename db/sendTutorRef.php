<?php
require "./connect.php";
session_start();
$id = $_SESSION["studentid"];
session_destroy();
$achievements = isset($_POST["studentsAchievements"]) ? $_POST["studentsAchievements"] : "";
$learningNeeds = $_POST["options-learningneeds"];
$learningNeedsDetails = isset($_POST["learningNeedsDetails"]) ? $_POST["learningNeedsDetails"] : "";
$learningSupport = $_POST["options-learningsupport"];
$learningSupportDetails = isset($_POST["learningSupportDetails"]) ? $_POST["learningSupportDetails"] : "";
$statemented = $_POST["options-statemented"];
$statementedDetails = isset($_POST["statementedDetails"]) ? $_POST["statementedDetails"] : "";
$specialConsideration = $_POST["options-specialconsideration"];
$specialConsiderationDetails = isset($_POST["specialConsiderationDetails"]) ? $_POST["specialConsiderationDetails"] : "";
$freeSchoolMeals = $_POST["options-freeschoolmeals"];
$tutorFirstName = isset($_POST["tutorFirstName"]) ? $_POST["tutorFirstName"] : "";
$tutorSurname = isset($_POST["tutorSurname"]) ? $_POST["tutorSurname"] : "";
$predictedOrActualGrades = $_POST["options-predictedoractualgrades"];

$sql = "
UPDATE applicant
SET studentachievements='$achievements', learningneeds='$learningNeeds', learningneedsdetails='$learningNeedsDetails', learningsupport='$learningSupport', learningsupportdetails='$learningSupportDetails', statemented='$statemented', statementeddetails='$statementedDetails', specialconsiderations='$specialConsideration', specialconsiderationsdetails='$specialConsiderationDetails', freeschoolmeals='$freeSchoolMeals', fnameoftutor='$tutorFirstName', snameoftutor='$tutorSurname', predictedoractualqualifications='$predictedOrActualGrades'
WHERE applicant_id='$id';
";

if (mysqli_query($link, $sql)){
  header ("Location: ../views/referencecomplete.html");
} else {

  //mysqli_error($link);
}
?>
