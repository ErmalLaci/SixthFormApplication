<?php
require "./connect.php";  //connect to server

//sql for getting custom inputs from database
$sql = "
SELECT name, type
FROM `storedinformation`
";

$result = mysqli_query($link, $sql);

$customInputValues = isset($_POST["customInputValues"]) ? json_decode($_POST["customInputValues"]) : "";  //get all values, json_decode used when getting json string as array
$numOfInputs = isset($_POST["numOfInputs"]) ? $_POST["numOfInputs"] : "";
$studentAchievements = isset($_POST["studentachievements"]) ? $_POST["studentachievements"] : "";
$learningNeeds = isset($_POST["learningNeeds"]) ? $_POST["learningNeeds"] : "";
$learningNeedsDetails = isset($_POST["learningNeedsDetails"]) ? $_POST["learningNeedsDetails"] : "";
$learningSupport = isset($_POST["learningSupport"]) ? $_POST["learningSupport"] : "";
$learningSupportDetails = isset($_POST["learningSupportDetails"]) ? $_POST["learningSupportDetails"] : "";
$statemented = isset($_POST["statemented"]) ? $_POST["statemented"] : "";
$statementedDetails = isset($_POST["statementedDetails"]) ? $_POST["statementedDetails"] : "";
$specialConsideration = isset($_POST["specialConsideration"]) ? $_POST["specialConsideration"] : "";
$specialConsiderationDetails = isset($_POST["specialConsiderationDetails"]) ? $_POST["specialConsiderationDetails"] : "";
$freeSchoolMeals = isset($_POST["freeSchoolMeals"]) ? $_POST["freeSchoolMeals"] : "";
$tutorFirstName = isset($_POST["tutorFirstName"]) ? $_POST["tutorFirstName"] : "";
$tutorSurname = isset($_POST["tutorSurname"]) ? $_POST["tutorSurname"] : "";
$predictedOrActualGrades = isset($_POST["predictedOrActualGrades"]) ? $_POST["predictedOrActualGrades"] : "";
$studentCourseInterest = isset($_POST["studentCourseInterest"]) ? $_POST["studentCourseInterest"] : "";
$entryRequirementsKnown = isset($_POST["entryRequirementsKnown"]) ? $_POST["entryRequirementsKnown"] : "";
$specialRequirementsDetails = isset($_POST["specialRequirementsDetails"]) ? $_POST["specialRequirementsDetails"] : "";
$interviewNotesDetails = isset($_POST["interviewNotesDetails"]) ? $_POST["interviewNotesDetails"] : "";
$enrichmentDetails = isset($_POST["enrichmentDetails"]) ? $_POST["enrichmentDetails"] : "";
$applicantId = isset($_POST["applicantId"]) ? $_POST["applicantId"] : "";
$accepted = isset($_POST["accepted"]) ? $_POST["accepted"] : "";
$subjects = isset($_POST["subjects"]) ? json_decode($_POST["subjects"]) : "";
$examBoards = isset($_POST["examBoards"]) ? json_decode($_POST["examBoards"]) : "";
$predictedGrades = isset($_POST["predictedGrades"]) ? json_decode($_POST["predictedGrades"]) : "";
$mockResults = isset($_POST["mockResults"]) ? json_decode($_POST["mockResults"]) : "";
$actualResults = isset($_POST["actualResults"]) ? json_decode($_POST["actualResults"]) : "";
$yearTakens = isset($_POST["yearTakens"]) ? json_decode($_POST["yearTakens"]) : "";
$blockAOption = isset($_POST["blockAOption"]) ? $_POST["blockAOption"] : "";
$blockBOption = isset($_POST["blockBOption"]) ? $_POST["blockBOption"] : "";
$blockCOption = isset($_POST["blockCOption"]) ? $_POST["blockCOption"] : "";
$blockDOption = isset($_POST["blockDOption"]) ? $_POST["blockDOption"] : "";
$blockEOption = isset($_POST["blockEOption"]) ? $_POST["blockEOption"] : "";
$level2Option = isset($_POST["level2Option"]) ? $_POST["level2Option"] : "";
$coursesReasons = isset($_POST["coursesReasons"]) ? $_POST["coursesReasons"] : "";

//update applicant sql
$sql = "
UPDATE applicant
INNER JOIN `selected courses`
ON `applicant`.applicant_id = `selected courses`.applicant_id
SET
";
$i = 0;
while($row = mysqli_fetch_array($result)){  //loop through all custom inputs
  if ($row[1] == "BIT"){  //check if the type of input is a bit
    $sql .= " $row[0] = $customInputValues[$i],"; //if it is then the sql should not use quotes
  } else {
    $sql .= " $row[0] = '$customInputValues[$i]',";
  }
  $i++;
}
//add all non custom inputs to sql
$sql .= "
studentcourseinterest = $studentCourseInterest,
entryrequirementsknown = $entryRequirementsKnown,
specialrequirements = '$specialRequirementsDetails',
interviewnotes = '$interviewNotesDetails',
enrichment = '$enrichmentDetails',
studentAchievements = '$studentAchievements',
learningneeds = $learningNeeds,
learningneedsdetails = '$learningNeedsDetails',
learningsupport = $learningSupport,
learningsupportdetails = '$learningSupportDetails',
statemented = $statemented,
statementeddetails = '$statementedDetails',
specialconsiderations = $specialConsideration,
specialconsiderationsdetails = '$specialConsiderationDetails',
freeschoolmeals = $freeSchoolMeals,
fnameoftutor = '$tutorFirstName',
snameoftutor = '$tutorSurname',
predictedoractualqualifications = $predictedOrActualGrades,
accepted = $accepted,
`selected courses`.block_a = $blockAOption,
`selected courses`.block_b = $blockBOption,
`selected courses`.block_c = $blockCOption,
`selected courses`.block_d = $blockDOption,
`selected courses`.block_e = $blockEOption,
`selected courses`.level2_block = $level2Option,
`selected courses`.courses_reasons = '$coursesReasons'
WHERE applicant.applicant_id = $applicantId
";

mysqli_query($link, $sql) or die(mysqli_error($link));

//get the grade ids for all the applicants grades
$sql = "
SELECT grade_id
FROM grades
WHERE applicant_id = $applicantId
";

if (count($subjects) > 0){  //check that there is at least one subject
  //creates sql statement to get the id of all the subjects the student has selected
  $getNewSubjectSql = "
  SELECT subject_id
  FROM subject
  WHERE name = '$subjects[0]' AND exam_board = '$examBoards[0]'
  ";
  if (count($subjects) > 1){  //check that there is more than one subjects
    for ($i = 1; $i < count($subjects); $i++){  //loop through all the subjects
      //use union to connect sql statements
      $getNewSubjectSql .= "
      UNION
      SELECT subject_id
      FROM subject
      WHERE name = '$subjects[$i]' AND exam_board = '$examBoards[$i]'
      ";
    }
  }
}

$result = mysqli_query($link, $sql);
$subjectResult = mysqli_query($link, $getNewSubjectSql);

$x = 0;
$updateGradesSql = "";
if (mysqli_num_rows($subjectResult) > 0){ //check that there is at least one id returned

  while (($row = mysqli_fetch_array($result)) && ($subjectRow = mysqli_fetch_array($subjectResult))){ //loop through both arrays
    $tempSql = "
    UPDATE `grades`
    SET
    `subject_id` = $subjectRow[0],
    `predicted_grade` = '$predictedGrades[$x]',
    `mock_result` = '$mockResults[$x]',
    `actual_result` = '$actualResults[$x]',
    `year_taken` = '$yearTakens[$x]'
    WHERE `grade_id` = $row[0];
    ";
    $x++;
    $updateGradesSql .= $tempSql; //store multiple update statements in the same string
  }
}
if (mysqli_num_rows($result) > $x){ //check if there are more grades than there are grades updates, this would be the case if the admin removed grades
  $i = 1;
  mysqli_data_seek($result, $x);  //set the result to start looping from where it left off previously

  while($row = mysqli_fetch_array($result)){  //loop through all grades which have now been removed
    $tempSql = "
    DELETE FROM grades
    WHERE grade_id = $row[0];
    ";
    $i++;
    $updateGradesSql .= $tempSql; //store sql to delete removed grades
  }
} else if (mysqli_num_rows($result) < count($subjects)){  //check if grades have been added
  for ($i = mysqli_num_rows($result); $i < count($subjects); $i++){ //loop through all added grades
    //Get id of subject to be added
    $getSubjectIdSql = "
    SELECT subject_id
    FROM subject
    WHERE name='$subjects[$i]' AND exam_board='$examBoards[$i]'
    ";
    $getSubjectIdResult = mysqli_query($link, $getSubjectIdSql);
    $getSubjectIdRow = mysqli_fetch_array($getSubjectIdResult);

    //adds row to grades
    $tempSql = "
    INSERT INTO `grades`(subject_id, predicted_grade, mock_result, actual_result, year_taken, applicant_id)
    VALUES ('" . $getSubjectIdRow[0] . "', '$predictedGrades[$x]', '$mockResults[$x]', '$actualResults[$x]', '$yearTakens[$x]', $applicantId);
    ";
    $updateGradesSql .= $tempSql;
  }
}
mysqli_multi_query($link, $updateGradesSql) or die(mysqli_error($link));  //run multiple queries
mysqli_close($link);
?>
