<?php
require "./connect.php";

$sql = "
SELECT name, type
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
$subjects = isset($_POST["subjects"]) ? json_decode($_POST["subjects"]) : "";
$examboards = isset($_POST["examboards"]) ? json_decode($_POST["examboards"]) : "";
$predictedgrades = isset($_POST["predictedgrades"]) ? json_decode($_POST["predictedgrades"]) : "";
$mockresults = isset($_POST["mockresults"]) ? json_decode($_POST["mockresults"]) : "";
$actualresults = isset($_POST["actualresults"]) ? json_decode($_POST["actualresults"]) : "";
$yeartakens = isset($_POST["yeartakens"]) ? json_decode($_POST["yeartakens"]) : "";
$blockAoption = isset($_POST["blockAoption"]) ? $_POST["blockAoption"] : "";
$blockBoption = isset($_POST["blockBoption"]) ? $_POST["blockBoption"] : "";
$blockCoption = isset($_POST["blockCoption"]) ? $_POST["blockCoption"] : "";
$blockDoption = isset($_POST["blockDoption"]) ? $_POST["blockDoption"] : "";
$blockEoption = isset($_POST["blockEoption"]) ? $_POST["blockEoption"] : "";
$level2option = isset($_POST["level2option"]) ? $_POST["level2option"] : "";
$coursesReasons = isset($_POST["coursesReasons"]) ? $_POST["coursesReasons"] : "";

$sql = "
UPDATE applicant
INNER JOIN `selected courses`
ON `applicant`.applicant_id = `selected courses`.applicant_id
SET
";
$i = 0;
while($row = mysqli_fetch_array($result)){
  if ($row[1] == "BIT"){
    $sql .= " $row[0] = $customInputValues[$i],";
  } else {
    $sql .= " $row[0] = '$customInputValues[$i]',";
  }
  $i++;
}

$sql .= "
studentcourseinterest = $studentcourseinterest,
entryrequirementsknown = $entryrequirementsknown,
specialrequirements = '$specialrequirementsDetails',
interviewnotes = '$interviewnotesDetails',
enrichment = '$enrichmentDetails',
studentachievements = '$studentachievements',
learningneeds = $learningneeds,
learningneedsdetails = '$learningNeedsDetails',
learningsupport = $learningsupport,
learningsupportdetails = '$learningSupportDetails',
statemented = $statemented,
statementeddetails = '$statementedDetails',
specialconsiderations = $specialconsideration,
specialconsiderationsdetails = '$specialConsiderationDetails',
freeschoolmeals = $freeschoolmeals,
fnameoftutor = '$tutorFirstName',
snameoftutor = '$tutorSurname',
predictedoractualqualifications = $predictedoractualgrades,
accepted = $accepted,
`selected courses`.block_a = $blockAoption,
`selected courses`.block_b = $blockBoption,
`selected courses`.block_c = $blockCoption,
`selected courses`.block_d = $blockDoption,
`selected courses`.block_e = $blockEoption,
`selected courses`.level2_block = $level2option,
`selected courses`.courses_reasons = '$coursesReasons'

WHERE applicant_id = $applicant_id
";
echo $sql;
mysqli_query($link, $sql) or die(mysqli_error($link));


$sql = "
SELECT grade_id
FROM grades
WHERE applicant_id = $applicant_id
";

if (count($subjects) > 0){
  $getNewSubjectSql = "
  SELECT subject_id
  FROM subject
  WHERE name = '$subjects[0]' AND exam_board = '$examboards[0]'
  ";
  if (count($subjects) > 1){
    for ($i = 1; $i < count($subjects); $i++){
      $getNewSubjectSql .= "
      UNION
      SELECT subject_id
      FROM subject
      WHERE name = '$subjects[$i]' AND exam_board = '$examboards[$i]'
      ";
    }
  }
}

$result = mysqli_query($link, $sql);
$subjectResult = mysqli_query($link, $getNewSubjectSql);

$x = 0;
$updateGradesSql = "";
if (mysqli_num_rows($subjectResult) > 0){

  while (($row = mysqli_fetch_array($result)) && ($subjectRow = mysqli_fetch_array($subjectResult))){
    $tempsql = "
    UPDATE `grades`
    SET
    `subject_id` = $subjectRow[0],
    `predicted_grade` = '$predictedgrades[$x]',
    `mock_result` = '$mockresults[$x]',
    `actual_result` = '$actualresults[$x]',
    `year_taken` = '$yeartakens[$x]'
    WHERE `grade_id` = $row[0];
    ";
    $x++;
    $updateGradesSql .= $tempsql;
  }
}
if (mysqli_num_rows($result) > $x){
  $i = 1;
  //echo $i;
  mysqli_data_seek($result, $x);

  while($row = mysqli_fetch_array($result)){
    $tempsql = "
    DELETE FROM grades
    WHERE grade_id = $row[0];
    ";
    $i++;
    $updateGradesSql .= $tempsql;
  }
}
 echo $updateGradesSql;
mysqli_multi_query($link, $updateGradesSql) or die(mysqli_error($link));
myslqi_close($link);
?>
