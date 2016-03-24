<?php
session_start();
require "../db/connect.php";

$id = isset($_GET["id"]) ? $_GET["id"] : "";

if (!is_numeric($id)){
  header ("Location: ./index.html");
}


$sql = "
SELECT fname, sname, gcsetaken1, gcsetaken2, gcsetaken3, gcsetaken4, gcsetaken5, gcsetaken6, gcsetaken6, gcsetaken7, gcsetaken8, gcsetaken9, gcsetaken10, gcsetaken11, gcsetaken12, gcsetaken13
FROM applicant
WHERE applicant_id = '$id'
";
//echo $sql;

$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if ($count == 0){
//  header ("Location: ./index.html");
}

$_SESSION["studentid"] = $id;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Highdown Sixth Form Online Application - Tutor Reference</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../style/loginpage/material.min.css">
  <link rel="stylesheet" href="../style/textpage/styles.css">
  <link rel="stylesheet" href="../style/stylesheet.css">
</head>

<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
      <div class="mdl-layout--large-screen-only mdl-layout__header-row">
      </div>
      <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        <h3>Highdown Sixth Form Online Application</h3>
      </div>
      <div class="mdl-layout--large-screen-only mdl-layout__header-row">
      </div>
    </header>
    <main class="mdl-layout__content" style="background-color: white;">
      <br>
      <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp formsection">
        <form name="TutorReferenceForm" action="../db/sendTutorRef.php" method="post" style="width: 100%">
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col">
              <button type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab collapsebutton" onclick="switchDisplay();">
                <i class="material-icons" id="collapsebutton">add</i>
              </button>
              Show students qualifications
            </div>
          </div>
          <div id="displayStudentsGrades"></div>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
              Tutor Reference
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col">1. Please comment on the student's achievements to date and the suitability of the student for the courses chosen</div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col" style="margin-top: 0;">
                  <!-- Floating Multiline Textfield -->
                  <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
                    <textarea class="mdl-textfield__input" type="text" rows="8" id="studentsAchievements" name="studentsAchievements"></textarea>
                    <label class="mdl-textfield__label" for="studentsAchievements">Text lines...</label>
                  </div>
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col">2. Learning Support</div>
              </div>
              <!-- Input -->
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--8-col">
                  Does this student have any specific learning needs?
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="learningneeds-option-1">
                    <input type="radio" id="learningneeds-option-1" class="mdl-radio__button" name="options-learningneeds" value="1" checked>
                    <span class="mdl-radio__label">Yes</span>
                  </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="learningneeds-option-2">
                    <input type="radio" id="learningneeds-option-2" class="mdl-radio__button" name="options-learningneeds" value="0">
                    <span class="mdl-radio__label">No</span>
                  </label>
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell--12-col">
                  <!-- Floating Multiline Textfield -->
                  <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
                    <textarea class="mdl-textfield__input" type="text" rows="3" id="learningneedsdetails" name="learningNeedsDetails"></textarea>
                    <label class="mdl-textfield__label" for="learningneeds-details">If yes, please provide details</label>
                  </div>
                </div>
              </div>
              <!-- Input -->
              <!-- Input -->
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--8-col">
                  Has this student ever recieved any learning support at school?
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="learningsupport-option-1">
                    <input type="radio" id="learningsupport-option-1" class="mdl-radio__button" name="options-learningsupport" value="1" checked>
                    <span class="mdl-radio__label">Yes</span>
                  </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="learningsupport-option-2">
                    <input type="radio" id="learningsupport-option-2" class="mdl-radio__button" name="options-learningsupport">
                    <span class="mdl-radio__label">No</span>
                  </label>
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell--12-col">
                  <!-- Floating Multiline Textfield -->
                  <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
                    <textarea class="mdl-textfield__input" type="text" rows="3" id="learningsupport-details" name="learningSupportDetails"></textarea>
                    <label class="mdl-textfield__label" for="learningsupport-details">If yes, please provide details</label>
                  </div>
                </div>
              </div>
              <!-- Input -->
              <!-- Input -->
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--8-col">
                  Has this student been statemented?
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="statemented-option-1">
                    <input type="radio" id="statemented-option-1" class="mdl-radio__button" name="options-statemented" value="1" checked>
                    <span class="mdl-radio__label">Yes</span>
                  </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="statemented-option-2">
                    <input type="radio" id="statemented-option-2" class="mdl-radio__button" name="options-statemented" value="0">
                    <span class="mdl-radio__label">No</span>
                  </label>
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell--12-col">
                  <!-- Floating Multiline Textfield -->
                  <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
                    <textarea class="mdl-textfield__input" type="text" rows="3" id="statemented-details" name="statementedDetails"></textarea>
                    <label class="mdl-textfield__label" for="statemented-details">If yes, please provide details</label>
                  </div>
                </div>
              </div>
              <!-- Input -->
              <!-- Input -->
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--8-col">
                  Has this student ever recieved special consideration in examinations?
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="specialconsideration-option-1">
                    <input type="radio" id="specialconsideration-option-1" class="mdl-radio__button" name="options-specialconsideration" value="1" checked>
                    <span class="mdl-radio__label">Yes</span>
                  </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="specialconsideration-option-2">
                    <input type="radio" id="specialconsideration-option-2" class="mdl-radio__button" name="options-specialconsideration" value="0">
                    <span class="mdl-radio__label">No</span>
                  </label>
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell--12-col">
                  <!-- Floating Multiline Textfield -->
                  <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
                    <textarea class="mdl-textfield__input" type="text" rows="3" id="specialconsideration-details" name="specialConsiderationDetails"></textarea>
                    <label class="mdl-textfield__label" for="specialconsideration-details">Extra time, scribe, transcript, reader, word processor etc. - please provide as much detail as possible</label>
                  </div>
                </div>
              </div>
              <!-- Input -->
              <!-- Input -->
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--8-col">
                  Has the student qualified for Free School Meals in the last 6 years?
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="freeschoolmeals-option-1">
                    <input type="radio" id="freeschoolmeals-option-1" class="mdl-radio__button" name="options-freeschoolmeals" value="1" checked>
                    <span class="mdl-radio__label">Yes</span>
                  </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="freeschoolmeals-option-2">
                    <input type="radio" id="freeschoolmeals-option-2" class="mdl-radio__button" name="options-freeschoolmeals" value="0">
                    <span class="mdl-radio__label">No</span>
                  </label>
                </div>
              </div>
              <br>
              <!-- Input -->
              <div class="mdl-grid">
                <div class="mdl-cell--6-col" style="margin-left:25px;">
                  <!-- Simple Textfield -->
                  <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" id="tutorFirstName" name="tutorFirstName">
                    <label class="mdl-textfield__label" for="tutorFirstName">Tutor First Name</label>
                  </div>
                </div>
                <div class="mdl-cell--6-col" style="margin-left:25px;">
                  <!-- Simple Textfield -->
                  <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" id="tutorSurname" name="tutorSurname">
                    <label class="mdl-textfield__label" for="tutorSurname">Tutor Surname</label>
                  </div>
                </div>
              </div>
              <!-- Input -->
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--8-col">
                  Predicted/Actual Qualifications Verified by current school
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="predictedoractualgrades-option-1">
                    <input type="radio" id="predictedoractualgrades-option-1" class="mdl-radio__button" name="options-predictedoractualgrades" value="1" checked>
                    <span class="mdl-radio__label">Actual</span>
                  </label>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="predictedoractualgrades-option-2">
                    <input type="radio" id="predictedoractualgrades-option-2" class="mdl-radio__button" name="options-predictedoractualgrades" value="0">
                    <span class="mdl-radio__label">Predicted</span>
                  </label>
                </div>
              </div>
              <!-- Input -->

              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                  <!-- Raised button with ripple -->
                  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">
                    Send Reference
                  </button>
                </div>
              </div>
            </div>
        </form>
      </section>

    </main>
    </div>
    <script src="../scripts/loginpage/material.min.js"></script>
    <script src="../scripts/loadTutorRef.js"></script>
    <script type="text/javascript">
        //collapse or expand depending on state
        function switchDisplay() {
            if (document.getElementById("displayStudentsGrades").style.display == "block") {
              document.getElementById("displayStudentsGrades").style.display = "none";
              document.getElementById("collapsebutton").innerHTML = "add";
            } else {
              document.getElementById("displayStudentsGrades").style.display = "block";
              document.getElementById("collapsebutton").innerHTML = "remove";
            }
            return false;
        }
    </script>
</body>

</html>
