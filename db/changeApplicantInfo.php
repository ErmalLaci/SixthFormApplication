<?php
require "./connect.php";

$sql = "
SELECT name
FROM `storedinformation`
";

$result = mysqli_query($link, $sql);


$customInputValues = isset($_POST["customInputValues"]) ? json_decode($_POST["customInputValues"]) : "";
$numOfInputs = isset($_POST["numOfInputs"]) ? $_POST["numOfInputs"] : "";
$studentachievements = isset($_POST["studentachievements"]) ? $_POST["studentachievements"] : "";
$learningneeds = isset($_POST["learningneeds"]) ? $_POST["learningneeds"] : "";
$learningNeedsDetails = isset($_POST["learningNeedsDetails"]) ? $_POST["learningNeedsDetails"] : "";
$learningsupport = isset($_POST["learningsupport"]) ? $_POST["learningsupport"] : "";
$learningSupportDetails = isset($_POST["learningSupportDetails"]) ? $_POST["learningSupportDetails"] : "";
$statemented = isset($_POST["statemented"]) ? $_POST["statemented"] : "";
$statementedDetails = isset($_POST["statementedDetails"]) ? $_POST["statementedDetails"] : "";
$specialconsideration = isset($_POST["specialconsideration"]) ? $_POST["specialconsideration"] : "";
$specialConsiderationDetails = isset($_POST["specialConsiderationDetails"]) ? $_POST["specialConsiderationDetails"] : "";
$freeschoolmeals = isset($_POST["freeschoolmeals"]) ? $_POST["freeschoolmeals"] : "";
$tutorFirstName = isset($_POST["tutorFirstName"]) ? $_POST["tutorFirstName"] : "";
$tutorSurname = isset($_POST["tutorSurname"]) ? $_POST["tutorSurname"] : "";
$predictedoractualgrades = isset($_POST["predictedoractualgrades"]) ? $_POST["predictedoractualgrades"] : "";
$studentcourseinterest = isset($_POST["studentcourseinterest"]) ? $_POST["studentcourseinterest"] : "";
$entryrequirementsknown = isset($_POST["entryrequirementsknown"]) ? $_POST["entryrequirementsknown"] : "";
$specialrequirementsDetails = isset($_POST["specialrequirementsDetails"]) ? $_POST["specialrequirementsDetails"] : "";
$interviewnotesDetails = isset($_POST["interviewnotesDetails"]) ? $_POST["interviewnotesDetails"] : "";
$enrichmentDetails = isset($_POST["enrichmentDetails"]) ? $_POST["enrichmentDetails"] : "";
$applicant_id = isset($_POST["applicant_id"]) ? $_POST["applicant_id"] : "";
$accepted = isset($_POST["accepted"]) ? $_POST["accepted"] : "";

$sql = "
UPDATE applicant
SET
";
$i = 0;
while($row = mysqli_fetch_array($result)){
  $sql .= " $row[0] = '$customInputValues[$i]',";
  $i++;
}

$sql .= "
studentcourseinterest = '$studentcourseinterest',
entryrequirementsknown = '$entryrequirementsknown',
specialrequirements = '$specialrequirementsDetails',
interviewnotes = '$interviewnotesDetails',
enrichment = '$enrichmentDetails',
studentachievements = '$studentachievements',
learningneeds = '$learningneeds',
learningneedsdetails = '$learningNeedsDetails',
learningsupport = '$learningsupport',
learningsupportdetails = '$learningSupportDetails',
statemented = '$statemented',
statementeddetails = '$statementedDetails',
specialconsiderations = '$specialconsideration',
specialconsiderationsdetails = '$specialConsiderationDetails',
freeschoolmeals = '$freeschoolmeals',
fnameoftutor = '$tutorFirstName',
snameoftutor = '$tutorSurname',
predictedoractualqualifications = '$predictedoractualgrades',
accepted = '$accepted'
WHERE applicant_id = $applicant_id
";

mysqli_query($link, $sql) or die(mysql_error());

echo $sql;


?>
