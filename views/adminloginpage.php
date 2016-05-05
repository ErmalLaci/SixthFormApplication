<?php
session_start();
$type = "admin";  //set type as admin
require "../db/checkLogin.php";
require "../db/connect.php";

$sql = "
SELECT *
FROM storedinformation
";

$inputNames = [];
$inputTypes = [];
$inputLengths = [];
$inputDisplays = [];
$inputValidates= [];

$i = 0;

$result = mysqli_query($link, $sql) or die(mysqli_error($link));  //get custom input details from stored information

$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)){ //assign all rows values
    $inputNames[$i] = $row["name"];
    $inputTypes[$i] = $row["type"];
    $inputLengths[$i] = $row["length"];
    $inputDisplays[$i] = $row["display"];
    $inputValidates[$i] = $row["validate"];
    $i++;
}

$sql = "SELECT "; //loop through custom inputs and add to sql statement
$sql .= $inputNames[0];
for ($x = 1; $x < count($inputNames); $x++){
    $sql .= ", `" . $inputNames[$x] . "`";
}

$sql .= ", `studentcourseinterest`, `entryrequirementsknown`, `specialrequirements`, `interviewnotes`, `enrichment`, `studentachievements`, `learningneeds`, `learningneedsdetails`, `learningsupport`, `learningsupportdetails`, `statemented`, `statementeddetails`, `specialconsiderations`, `specialconsiderationsdetails`, `freeschoolmeals`, `fnameoftutor`, `snameoftutor`, `predictedoractualqualifications`, `entryrequirementsknown`, `specialrequirements`, `interviewnotes`, `enrichment`, `accepted`, `applicant_id`  From applicant";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Home</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../style/loginpage/material.min.css">
        <link rel="stylesheet" href="../style/loginpage/styles.css">
    </head>

    <body>
        <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">Home</span>
                    <div class="mdl-layout-spacer"></div>
                    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                        <li class="mdl-menu__item">About</li>
                        <li class="mdl-menu__item">Contact</li>
                    </ul>
                </div>
            </header>
            <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
                <header class="demo-drawer-header">
                    <div class="demo-avatar-dropdown">
                        <span>
                            <span id="displayusername"></span>
                        <br>
                        <span id="display-usertype"></span>
                        </span>
                        <div class="mdl-layout-spacer"></div>
                    </div>
                </header>
                <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
                    <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
                    <a class="mdl-navigation__link" href="./admininbox.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
                    <a class="mdl-navigation__link" href="./adminmanageaccounts.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">supervisor_account</i>Manage Admin/Teacher Accounts</a>
                    <a class="mdl-navigation__link" href="./admineditform.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">edit</i>Edit Form</a>
                    <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>

                </nav>
            </div>
            <main class="mdl-layout__content mdl-color--grey-100">
                <!-- Admin Controls -->
                <!-- Applicant search -->
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col" style="border-style: outset;">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--4-col">
                                Applicants
                            </div>
                            <div class="mdl-cell mdl-cell--8-col">
                              <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="text" id="ApplicantSearch" onkeyup="searchApplicants();">
                                <label class="mdl-textfield__label" for="ApplicantSearch">Search for an applicant</label>
                              </div>
                            </div>
                        </div>
                        <div id="applicantDisplay">
                            <?php
                            $addedHTML = "";
                            $x = 0;
                            while($row = mysqli_fetch_array($result)){  //loop through for each each applicant
                              $getGrades = "
                              SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
                              FROM `grades`
                              INNER JOIN subject ON grades.subject_id = subject.subject_id
                              WHERE grades.applicant_id = '" . $row['applicant_id'] . "'
                              ";
                              $gotGrades = mysqli_query($link, $getGrades); //get applicants grades
                              $gradesHTML = "
                              <div class='mdl-grid'>
                                  <div class='mdl-cell mdl-cell--12-col'>
                                      <table class='mdl-data-table mdl-js-data-table'>
                                          <thead>
                                              <tr>
                                                  <th class='mdl-data-table__cell--non-numeric'>Subject</th>
                                                  <th class='mdl-data-table__cell--non-numeric'>Exam Board</th>
                                                  <th class='mdl-data-table__cell--non-numeric'>Predicted Grade</th>
                                                  <th class='mdl-data-table__cell--non-numeric'>Mock Result</th>
                                                  <th class='mdl-data-table__cell--non-numeric'>Actual Result</th>
                                                  <th class='mdl-data-table__cell--non-numeric'>Year Taken</th>
                                              </tr>
                                          </thead>
                                          <tbody>";

                              $z = 0;
                              while($gotGradesArray = mysqli_fetch_array($gotGrades)){  //create display for grades
                                $gradesHTML .= "
                                <tr>
                                <td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='subject-" .  $z . "-applicant" . $x . "' name='subject-" .  $z. "-applicant" . $x . "' value='" . $gotGradesArray['name'] . "'>

                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='exam_board-" .  $z . "-applicant" . $x . "' name='exam_board-" .  $z. "-applicant" . $x . "' value='" . $gotGradesArray['exam_board'] . "'>

                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='predicted_grade-" .  $z . "-applicant" . $x . "' name='predicted_grade-" .  $z. "-applicant" . $x . "' value='" . $gotGradesArray['predicted_grade'] . "'>

                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='mock_result-" .  $z . "-applicant" . $x . "' name='mock_result-" .  $z. "-applicant" . $x . "' value='" . $gotGradesArray['mock_result'] . "'>

                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='actual_result-" .  $z . "-applicant" . $x . "' name='actual_result-" .  $z. "-applicant" . $x . "' value='" . $gotGradesArray['actual_result'] . "'>

                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='year_taken-" .  $z . "-applicant" . $x . "' name='year_taken-" .  $z. "-applicant" . $x . "' value='" . $gotGradesArray['year_taken'] . "'>
                                </td>
                                </tr>";

                                $z++;
                              }

                              for ($emptyRowCreation = mysqli_num_rows($gotGrades); $emptyRowCreation < 13; $emptyRowCreation++){ //create empty rows if the applicant didnt fill out all 13 rows
                                $gradesHTML .= "
                                <tr>
                                <td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='subject-" .  $emptyRowCreation. "-applicant" . $x . "' name='subject-" .  $emptyRowCreation. "-applicant" . $x . "'>
                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='exam_board-" .  $emptyRowCreation. "-applicant" . $x . "' name='exam_board-" .  $emptyRowCreation. "-applicant" . $x . "'>
                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='predicted_grade-" .  $emptyRowCreation. "-applicant" . $x . "' name='predicted_grade-" .  $emptyRowCreation. "-applicant" . $x . "'>
                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='mock_result-" .  $emptyRowCreation. "-applicant" . $x . "' name='mock_result-" .  $emptyRowCreation. "-applicant" . $x . "'>
                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='actual_result-" .  $emptyRowCreation. "-applicant" . $x . "' name='actual_result-" .  $emptyRowCreation. "-applicant" . $x . "'>
                                </td><td class='mdl-data-table__cell--non-numeric'>
                                <input class='mdl-textfield__input' type='text' id='year_taken-" .  $emptyRowCreation. "-applicant" . $x . "' name='year_taken-" .  $emptyRowCreation. "-applicant" . $x . "'>
                                </td>
                                </tr>";
                              }
                              $gradesHTML .= "</tbody></table></div></div>";
                              //echo htmlentities($gradesHTML);

                              $selectedCoursesHTML = "";  //
                              $showCourses = "
                              SELECT `sixthformsubject_id`, `name`,`level`,`block`
                              FROM `sixth form subject`
                              ";
                              $shownCourses = mysqli_query($link, $showCourses);

                              $blockAHTML = "";
                              $blockBHTML = "";
                              $blockCHTML = "";
                              $blockDHTML = "";
                              $blockEHTML = "";
                              $level2HTML = "";

                              while ($shownCoursesArray = mysqli_fetch_array($shownCourses)){ //create sixth form subject display blocks tables
                                  if ($shownCoursesArray["level"] == "A Level") {
                                      if ($shownCoursesArray["block"] == "A") {
                                          $blockAHTML .= "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' id='" . $shownCoursesArray["name"] . $shownCoursesArray["block"] . $x . "' name='blockA-options-applicant" . $x . "' value='" . $shownCoursesArray["sixthformsubject_id"] . "'>" . $shownCoursesArray["name"] . "</td></tr>";
                                      } else if ($shownCoursesArray["block"] == "B") {
                                          $blockBHTML .= "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' id='" . $shownCoursesArray["name"] . $shownCoursesArray["block"] . $x . "' name='blockB-options-applicant" . $x . "' value='" . $shownCoursesArray["sixthformsubject_id"] . "'>" . $shownCoursesArray["name"] . "</td></tr>";
                                      } else if ($shownCoursesArray["block"] == "C") {
                                          $blockCHTML .= "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' id='" . $shownCoursesArray["name"] . $shownCoursesArray["block"] . $x . "' name='blockC-options-applicant" . $x . "' value='" . $shownCoursesArray["sixthformsubject_id"] . "'>" . $shownCoursesArray["name"] . "</td></tr>";
                                      } else if ($shownCoursesArray["block"] == "D") {
                                          $blockDHTML .= "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' id='" . $shownCoursesArray["name"] . $shownCoursesArray["block"] . $x . "' name='blockD-options-applicant" . $x . "' value='" . $shownCoursesArray["sixthformsubject_id"] . "'>" . $shownCoursesArray["name"] . "</td></tr>";
                                      } else if ($shownCoursesArray["block"] == "E") {
                                          $blockEHTML .= "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' id='" . $shownCoursesArray["name"] . $shownCoursesArray["block"] . $x . "' name='blockE-options-applicant" . $x . "' value='" . $shownCoursesArray["sixthformsubject_id"] . "'>" . $shownCoursesArray["name"] . "</td></tr>";
                                      }
                                  } else if ($shownCoursesArray["level"] == "Level 2") {
                                      $level2HTML .= "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' id='" . $shownCoursesArray["name"] . "level2' name='level2-options-applicant" . $x . "' value='" . $shownCoursesArray["sixthformsubject_id"] . "'>" . $shownCoursesArray["name"] . "</td></tr>";
                                  }
                              }

                              $applicantsChoice = "
                              SELECT name, level, block
                              FROM `sixth form subject`
                              INNER JOIN `selected courses`
                              ON `selected courses`.block_a = `sixth form subject`.sixthformsubject_id
                              INNER JOIN applicant
                              ON `selected courses`.applicant_id = applicant.applicant_id
                              WHERE applicant.applicant_id = " . $row['applicant_id'] . "
                              UNION
                              SELECT name, level, block
                              FROM `sixth form subject`
                              INNER JOIN `selected courses`
                              ON `selected courses`.block_b = `sixth form subject`.sixthformsubject_id
                              INNER JOIN applicant
                              ON `selected courses`.applicant_id = applicant.applicant_id
                              WHERE applicant.applicant_id = " . $row['applicant_id'] . "
                              UNION
                              SELECT name, level, block
                              FROM `sixth form subject`
                              INNER JOIN `selected courses`
                              ON `selected courses`.block_c = `sixth form subject`.sixthformsubject_id
                              INNER JOIN applicant
                              ON `selected courses`.applicant_id = applicant.applicant_id
                              WHERE applicant.applicant_id = " . $row['applicant_id'] . "
                              UNION
                              SELECT name, level, block
                              FROM `sixth form subject`
                              INNER JOIN `selected courses`
                              ON `selected courses`.block_d = `sixth form subject`.sixthformsubject_id
                              INNER JOIN applicant
                              ON `selected courses`.applicant_id = applicant.applicant_id
                              WHERE applicant.applicant_id = " . $row['applicant_id'] . "
                              UNION
                              SELECT name, level, block
                              FROM `sixth form subject`
                              INNER JOIN `selected courses`
                              ON `selected courses`.block_e = `sixth form subject`.sixthformsubject_id
                              INNER JOIN applicant
                              ON `selected courses`.applicant_id = applicant.applicant_id
                              WHERE applicant.applicant_id = " . $row['applicant_id'] . "
                              UNION
                              SELECT name, level, block
                              FROM `sixth form subject`
                              INNER JOIN `selected courses`
                              ON `selected courses`.level2_block = `sixth form subject`.sixthformsubject_id
                              INNER JOIN applicant
                              ON `selected courses`.applicant_id = applicant.applicant_id
                              WHERE applicant.applicant_id = " . $row['applicant_id'] . "
                              ";
                              //get applicants selected sixth form subjects
                              $applicantsChoiceResult = mysqli_query($link, $applicantsChoice);
                              $blockAChoice = "";
                              $blockBChoice = "";
                              $blockCChoice = "";
                              $blockDChoice = "";
                              $blockEChoice = "";
                              $level2Choice = "";
                              //
                              while ($applicantsChoiceArray = mysqli_fetch_array($applicantsChoiceResult)){
                                if ($applicantsChoiceArray["level"] == "Level 2"){
                                  $level2Choice = $applicantsChoiceArray["name"] . "level2";
                                } else {
                                  if($applicantsChoiceArray["block"] == "A"){
                                    $blockAChoice = $applicantsChoiceArray["name"] . $applicantsChoiceArray["block"] . $x;
                                  } else if($applicantsChoiceArray["block"] == "B"){
                                    $blockBChoice = $applicantsChoiceArray["name"] . $applicantsChoiceArray["block"] . $x;
                                  } else if($applicantsChoiceArray["block"] == "C"){
                                    $blockCChoice = $applicantsChoiceArray["name"] . $applicantsChoiceArray["block"] . $x;
                                  } else if($applicantsChoiceArray["block"] == "D"){
                                    $blockDChoice = $applicantsChoiceArray["name"] . $applicantsChoiceArray["block"] . $x;
                                  } else if($applicantsChoiceArray["block"] == "E"){
                                    $blockEChoice = $applicantsChoiceArray["name"] . $applicantsChoiceArray["block"] . $x;
                                  }
                                }
                              }
                              $selectedCoursesHTML = "
                              <div class='mdl-grid'>
                                <div class='mdl-cell mdl-cell--12-col'>
                                  <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--6-col'>
                                      <table class='mdl-data-table mdl-js-data-table' width='100%'>
                                        <thead>
                                          <tr>
                                            <th class='mdl-data-table__cell--non-numeric'>Block A</th>
                                          </tr>
                                        </thead>
                                        <tbody id='blockA-table-applicant" . $x ."'>
                                        " . $blockAHTML . "
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class='mdl-cell mdl-cell--6-col'>
                                      <table class='mdl-data-table mdl-js-data-table' width='100%'>
                                        <thead>
                                          <tr>
                                            <th class='mdl-data-table__cell--non-numeric'>Block B</th>
                                          </tr>
                                        </thead>
                                        <tbody id='blockB-table-applicant" . $x ."'>
                                        " . $blockBHTML . "
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--6-col'>
                                      <table class='mdl-data-table mdl-js-data-table' width='100%'>
                                        <thead>
                                          <tr>
                                            <th class='mdl-data-table__cell--non-numeric'>Block C</th>
                                          </tr>
                                        </thead>
                                        <tbody id='blockC-table-applicant" . $x ."'>
                                        " . $blockCHTML . "
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class='mdl-cell mdl-cell--6-col'>
                                      <table class='mdl-data-table mdl-js-data-table' width='100%'>
                                        <thead>
                                          <tr>
                                            <th class='mdl-data-table__cell--non-numeric'>Block D</th>
                                          </tr>
                                        </thead>
                                        <tbody id='blockD-table-applicant" . $x ."'>
                                        " . $blockDHTML . "
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--6-col'>
                                      <table class='mdl-data-table mdl-js-data-table' width='100%'>
                                        <thead>
                                          <tr>
                                            <th class='mdl-data-table__cell--non-numeric'>Block E</th>
                                          </tr>
                                        </thead>
                                        <tbody id='blockE-table-applicant" . $x ."'>
                                        " . $blockEHTML . "
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class='mdl-cell mdl-cell--6-col'>
                                      <table class='mdl-data-table mdl-js-data-table' width='100%'>
                                        <thead>
                                          <tr>
                                            <th class='mdl-data-table__cell--non-numeric'>Level 2</th>
                                          </tr>
                                        </thead>
                                        <tbody id='level2-table-applicant" . $x ."'>
                                        " . $level2HTML . "
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--12-col'>
                                      <center>
                                        <div class='mdl-textfield mdl-js-textfield' style='width:80%;'>
                                          <textarea class='mdl-textfield__input' type='text' rows='8' id='courses_reasons-input-applicant" . $x . "' name='courses_reasons-input-applicant" . $x . "'></textarea>
                                          <label class='mdl-textfield__label' for='courses_reasons-input-applicant" . $x . "'>Why do you want to study this course?</label>
                                        </div>
                                      </center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <script>
                              try{
                                document.getElementById('" . $blockAChoice . "').checked = true;
                              }catch(err){}
                              try{
                                document.getElementById('" . $blockBChoice . "').checked = true;
                              }catch(err){}
                              try{
                                document.getElementById('" . $blockCChoice . "').checked = true;
                              }catch(err){}
                              try{
                                document.getElementById('" . $blockDChoice . "').checked = true;
                              }catch(err){}
                              try{
                                document.getElementById('" . $blockEChoice . "').checked = true;
                              }catch(err){}
                              try{
                                document.getElementById('" . $level2Choice . "').checked = true;
                              }catch(err){}
                              </script>
                              ";
                              //js checks block choices, use try catch because one of them might not be set

                              //decide which radio buttons is checked in radio button groups
                                if ($row["learningneeds"] == 0){
                                    $learningneeds1 = "";
                                    $learningneeds2 = "checked";
                                } else {
                                    $learningneeds1 = "checked";
                                    $learningneeds2 = "";
                                }
                                if ($row["learningsupport"] == 0){
                                    $learningsupport1 = "";
                                    $learningsupport2 = "checked";
                                } else {
                                    $learningsupport1 = "checked";
                                    $learningsupport2 = "";
                                }
                                if ($row["statemented"] == 0){
                                    $statemented1 = "";
                                    $statemented2 = "checked";
                                } else {
                                    $statemented1 = "checked";
                                    $statemented2 = "";
                                }
                                if ($row["specialconsiderations"] == 0){
                                    $specialconsiderations1 = "";
                                    $specialconsiderations2 = "checked";
                                } else {
                                    $specialconsiderations1 = "checked";
                                    $specialconsiderations2 = "";
                                }
                                if ($row["freeschoolmeals"] == 0){
                                    $freeschoolmeals1 = "";
                                    $freeschoolmeals2 = "checked";
                                } else {
                                    $freeschoolmeals1 = "checked";
                                    $freeschoolmeals2 = "";
                                }
                                if ($row["predictedoractualqualifications"] == 0){
                                    $predictedoractualqualifications1 = "";
                                    $predictedoractualqualifications2= "checked";
                                } else {
                                    $predictedoractualqualifications1 = "checked";
                                    $predictedoractualqualifications2 = "";
                                }
                                if ($row["studentcourseinterest"] == 0){
                                    $studentcourseinterest1 = "";
                                    $studentcourseinterest2 = "checked";
                                } else {
                                    $studentcourseinterest1 = "checked";
                                    $studentcourseinterest2 = "";
                                }
                                if ($row["entryrequirementsknown"] == 0){
                                    $entryrequirementsknown1 = "";
                                    $entryrequirementsknown2 = "checked";
                                } else {
                                    $entryrequirementsknown1 = "checked";
                                    $entryrequirementsknown2 = "";
                                }
                                if ($row["accepted"] == 0){
                                    $accepted1 = "";
                                    $accepted2 = "checked";
                                } else {
                                    $accepted1 = "checked";
                                    $accepted2 = "";
                                }

                                $addedHTML .= "
                                <div class='mdl-grid applicantsInfo' id='" . $row['fname'] . " " . $row['sname'] . $x . "'>
                                <div class='mdl-cell mdl-cell--12-col'>
                                <button type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab collapsebutton' onclick='switchDisplay(" . $x . ");'>
                                <i class='material-icons' id='collapsebutton" . $x ."'>add</i>
                                </button> " . $row["fname"] . " " . $row["sname"] . " ID: <span id='" . $x . "'>" . $row["applicant_id"] . "</span>
                                <div class='mdl-grid collapse'>";
                                for($i = 0; $i < count($inputNames); $i++){ //loop through all the custom inputs
                                    if ($inputTypes[$i] == "VARCHAR") { //Check the type of data, depending on the type of data there will be a different display
                                        //If type is varchar then create a textfield
                                        if ($inputValidates[$i] == "numeric"){  //if validates is numeric then create a number textfield
                                          $addedHTML .= "
                                          <div class='mdl-cell mdl-cell--6-col'><div class='mdl-textfield mdl-js-textfield  mdl-textfield--floating-label applicationInputs'>
                                          <input class='mdl-textfield__input input-varchar " . $inputValidates[$i] . " applicant" . $x . "' value='" . $row[$inputNames[$i]] . "' type='text' pattern='[0-9]*(\.[0-9]+)?' name='applicant" . $x . "input" . $i . "'
                                          id='applicant" . $x . "input" . $i . "' maxlength='" . $inputLengths[$i] . "'>
                                          <label class='mdl-textfield__label' for='applicant" . $x . "input" . $i . "'>" . $inputDisplays[$i] . "</label>
                                          <span class='mdl-textfield__error'>Input is not a number!</span>
                                          </div></div>";
                                        } else {
                                          $addedHTML .= "
                                          <div class='mdl-cell mdl-cell--6-col'><div class='mdl-textfield mdl-js-textfield  mdl-textfield--floating-label applicationInputs'>
                                          <input class='mdl-textfield__input input-varchar " . $inputValidates[$i] . " applicant" . $x . "' value='" . $row[$inputNames[$i]] . "' type='text' name='applicant" . $x . "input" . $i . "'
                                          id='applicant" . $x . "input" . $i . "' maxlength='" . $inputLengths[$i] . "'>
                                          <label class='mdl-textfield__label' for='applicant" . $x . "input" . $i . "'>" . $inputDisplays[$i] . "</label>
                                          </div></div>";
                                        }
                                    } else if ($inputTypes[$i] == "ENUM") { //create select input
                                        //Split the options variable at the comma to get each option in the table
                                        $options = explode(",", $inputLengths[$i]);
                                        //If the type is enum then create a dropdown mdl-textfield__input
                                        $addedHTML .= "<div class='mdl-grid'><div class='mdl-cell mdl-cell--2-col'>" . $inputDisplays[$i] . "</div><div class='mdl-cell mdl-cell--4-col'><select class='input-enum' name='applicant" . $x . "input" . $i . "' id='applicant" . $x . "input" . $i . "'>";
                                        for ($y = 0; $y < count($options); $y++) { //loops for each option
                                            $addedHTML .= ":<option value='" . $options[$y] . "'>" . strtoupper($options[$y]) . "</option>"; //creates an option in the dropdown for each valid answer
                                        }
                                        $addedHTML .= "</select></div></div>";
                                    } else if ($inputTypes[$i] == "BIT") {
                                    //If the type is bit then it creates radio buttons as I use bits where 1 is true and 0 is false
                                        if($row[$inputNames[$i]] == 1){
                                          $input1 = "checked";
                                          $input2 = "";
                                        }else{
                                          $input1 = "";
                                          $input2 = "checked";
                                        }

                                        $addedHTML .= "<div class='mdl-grid'><div class='mdl-cell mdl-cell--12-col'>" . $inputDisplays[$i] . "</div></div><div class='mdl-grid'><div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='radioButton" . $i . "-option-1'>
                                        <input type='radio' id='radioButton" . $i . "-option-1' class='mdl-radio__button' name='applicant" . $x . "input" . $i . "' value='1' $input1>
                                        <span class='mdl-radio__label'>Yes</span></label></div><div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='radioButton" . $i . "-option-2'>
                                        <input type='radio' id='radioButton" . $i . "-option-2' class='mdl-radio__button' name='applicant" . $x . "input" . $i . "' value='0' $input2>
                                        <span class='mdl-radio__label'>No</span></label></div></div>";
                                    } else if ($inputTypes[$i] == "YEAR") {
                                        //If the type is year then create a dropdown
                                        //Split at the - as the length will hold the minimum and maximum years
                                        $options = explode("-", $inputLengths[$i]);
                                        //Make sure minYear and maxYear are integers as I use a comparison operator later
                                        $minYear = $options[0];
                                        $maxYear = $options[1];
                                        $currentYear = $minYear;
                                        $addedHTML .= "<div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'>" . $inputDisplays[$i] . "</div><div class='mdl-cell mdl-cell--4-col'><select class='input-enum' name='applicant" . $x . "input" . $i . "' id='applicant" . $x . "input" . $i . "'>";
                                        while ($maxYear >= $currentYear) { //Loop for each of the years available
                                            $addedHTML .= ":<option value='" . $currentYear . "'>" . $currentYear . "</option>";
                                            $currentYear += 1;
                                        }
                                    $addedHTML .= "</select></div></div>";
                                    }
                                }
                                $addedHTML .= $gradesHTML;
                                $addedHTML .= $selectedCoursesHTML;
                                //add tutor reference inputs to html
                                $addedHTML .= "
                                <div id='applicant" . $x . "TutorReference'>
                                <div class='mdl-grid'>
                                <div class='mdl-cell mdl-cell--12-col'>
                                Tutor Reference
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--12-col'>1. Please comment on the student's achievements to date and the suitability of the student for the courses chosen</div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--12-col' style='margin-top: 0;'>
                                        <!-- Floating Multiline Textfield -->
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='8' id = 'applicant" . $x . "studentsAchievements' name = 'applicant" . $x . "studentsAchievements'>" . $row["studentachievements"] . "</textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "studentsAchievements'>Text lines...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--12-col'>2. Learning Support</div>
                                </div>
                                <!-- Input -->
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Does this student have any specific learning needs?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "learningneeds-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "learningneeds-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-learningneeds' value='1' $learningneeds1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "learningneeds-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "learningneeds-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-learningneeds' value='0' $learningneeds2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <!-- Floating Multiline Textfield -->
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "learningneeds-details' name = 'applicant" . $x . "learningNeedsDetails'></textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "learningneeds-details'>If yes, please provide details</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input -->
                                <!-- Input -->
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Has this student ever recieved any learning support at school?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "learningsupport-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "learningsupport-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-learningsupport' value='1' $learningsupport1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "learningsupport-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "learningsupport-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-learningsupport' value='0' $learningsupport2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <!-- Floating Multiline Textfield -->
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "learningsupport-details' name = 'applicant" . $x . "learningSupportDetails'></textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "learningsupport-details'>If yes, please provide details</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input -->
                                <!-- Input -->
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Has this student been statemented?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "statemented-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "statemented-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-statemented' value='1' $statemented1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "statemented-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "statemented-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-statemented' value='0' $statemented2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <!-- Floating Multiline Textfield -->
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "statemented-details' name = 'applicant" . $x . "statementedDetails'></textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "statemented-details'>If yes, please provide details</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input -->
                                <!-- Input -->
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Has this student ever recieved special consideration in examinations?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "specialconsideration-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "specialconsideration-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-specialconsideration' value='1' $specialconsiderations1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "specialconsideration-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "specialconsideration-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-specialconsideration' value='0' $specialconsiderations2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "specialconsideration-details' name = 'applicant" . $x . "specialConsiderationDetails'></textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "specialconsideration-details'>Extra time, scribe, transcript, reader, word processor etc. - please provide as much detail as possible</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input -->
                                <!-- Input -->
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Has the student qualified for Free School Meals in the last 6 years?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "freeschoolmeals-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "freeschoolmeals-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-freeschoolmeals' value='1' $freeschoolmeals1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "freeschoolmeals-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "freeschoolmeals-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-freeschoolmeals' value='0' $freeschoolmeals2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <!-- Input -->
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--6-col' style='margin-left:25px;'>
                                        <!-- Simple Textfield -->
                                        <div class='mdl-textfield mdl-js-textfield'>
                                            <input class='mdl-textfield__input' type='text' id = 'applicant" . $x . "tutorFirstName' name = 'applicant" . $x . "tutorFirstName'>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "tutorFirstName'>Tutor First Name</label>
                                        </div>
                                    </div>
                                    <div class='mdl-cell--6-col' style='margin-left:25px;'>
                                        <!-- Simple Textfield -->
                                        <div class='mdl-textfield mdl-js-textfield'>
                                            <input class='mdl-textfield__input' type='text' id = 'applicant" . $x . "tutorSurname' name = 'applicant" . $x . "tutorSurname'>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "tutorSurname'>Tutor Surname</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input -->
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Predicted/Actual Qualifications Verified by current school
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "predictedoractualgrades-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "predictedoractualgrades-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-predictedoractualgrades' value='1' $predictedoractualqualifications1>
                                            <span class='mdl-radio__label'>Actual</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "predictedoractualgrades-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "predictedoractualgrades-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-predictedoractualgrades' value='0' $predictedoractualqualifications2>
                                            <span class='mdl-radio__label'>Predicted</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Is the applicant interested in the course?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "studentcourseinterest-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "studentcourseinterest-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-studentcourseinterest' value='1' $studentcourseinterest1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "studentcourseinterest-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "studentcourseinterest-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-studentcourseinterest' value='0' $studentcourseinterest2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Does the applicant know the entry requirements for their course?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "entryrequirementsknown-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "entryrequirementsknown-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-entryrequirementsknown' value='1' $entryrequirementsknown1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "entryrequirementsknown-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "entryrequirementsknown-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-entryrequirementsknown' value='0' $entryrequirementsknown2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "specialrequirements-details' name = 'applicant" . $x . "specialrequirementsDetails'></textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "Does the applicant have any special requirements?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "interviewnotes-details' name = 'applicant" . $x . "interviewnotesDetails'></textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "interviewnotes-details'>Interview Notes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "enrichment-details' name = 'applicant" . $x . "enrichmentDetails'></textarea>
                                            <label class='mdl-textfield__label' for = 'applicant" . $x . "enrichment-details'>Enrichment</label>
                                        </div>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--8-col'>
                                        Accepted?
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "accepted-option-1'>
                                            <input type='radio' id = 'applicant" . $x . "accepted-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-accepted' value='1' $accepted1>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "accepted-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "accepted-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-accepted' value='0' $accepted2>
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Input -->
                            </div>
                              </div>
                                </div></div></div></div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent' onclick='validateToSendChanges(" . $row['applicant_id'] . ", " . $x . ", " . $count . ");'>
                                            Submit changes
                                        </button>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent' onclick='deleteApplication(" . $row['applicant_id'] . ");'>
                                            Delete Application
                                        </button>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--12-col' style='color:red;' id='applicationError'>

                                    </div>
                                    </div>
                                  </div>
                                  </div>
                                ";
                                //add buttons for each applicant to update and delete
                                $x++;
                            }

                            echo $addedHTML;
                            ?>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Applicant search -->
            </main>
        </div>
        <script src="../scripts/loginpage/material.min.js"></script>
        <script src="../scripts/loadUserData.js"></script>
        <script src="../scripts/changeApplicantInfo.js"></script>
        <script type="text/javascript">
            var elements = document.getElementsByClassName("collapse");
            // collapse all sections
            for (var i = 0; i < elements.length; i++) { //loop through all collapse divs
                elements[i].style.display = "none"; //hide all the divs
            }
            //collapse or expand depending on state
            function switchDisplay(i) { //create function to switch display
                if (elements[i].style.display == "none") {  //if div is hidden, make it visible and change the icon
                    elements[i].style.display = "block";
                    document.getElementById("collapsebutton" + i).innerHTML = "remove";
                } else {
                    elements[i].style.display = "none"; //div is visible hide it and change the icon
                    document.getElementById("collapsebutton" + i).innerHTML = "add";
                }
                return false;
            }

            function searchApplicants(){  //activate on keyup in search bar
              var allApplicants = document.getElementsByClassName("applicantsInfo");
              var input = document.getElementById("ApplicantSearch").value;
              var applicantId = [];
              if (input != ""){ //check if input isnt empty
                for (var x = 0; x < allApplicants.length; x++){ //loop through applicant classes
                  applicantId[x] = allApplicants[x].id;
                  if (applicantId[x].toLowerCase().includes(input.toLowerCase())){  //check if class includes input, should be case insensitive
                    allApplicants[x].style.display = "block"; //if yes then show
                  }else{
                      allApplicants[x].style.display = "none"; //if no then hide
                  }
                }
              } else {
                for (var x = 0; x < allApplicants.length; x++){ //if input is empty loop through all classes and make them visible
                  allApplicants[x].style.display = "block";
                }
              }
            }
        </script>
    </body>

    </html>
