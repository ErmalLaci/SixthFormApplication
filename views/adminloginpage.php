<?php
session_start();
$type = "admin";
require "../db/checklogin.php";
require "../db/connect.php";

$sql = "
SELECT name, type, length, display, validate
FROM storedinformation
";

$inputNames = [];
$inputTypes = [];
$inputLengths = [];
$inputDisplays = [];
$inputValidates= [];

$i = 0;

$result = mysqli_query($link, $sql) or die(mysqli_error($link));

while ($row = mysqli_fetch_assoc($result)){
    $inputNames[$i] = $row["name"];
    $inputTypes[$i] = $row["type"];
    $inputLengths[$i] = $row["length"];
    $inputDisplays[$i] = $row["display"];
    $inputValidates[$i] = $row["validate"];
    $i++;
}

$sql = "SELECT ";
$sql .= $inputNames[0];
for ($x = 1; $x < count($inputNames); $x++){
    $sql .= ", `" . $inputNames[$x] . "`";
}

$sql .= ", `studentachievements`, `learningneeds`, `learningneedsdetails`, `learningsupport`, `learningsupportdetails`, `statemented`, `statementeddetails`, `specialconsiderations`, `specialconsiderationsdetails`, `freeschoolmeals`, `fnameoftutor`, `snameoftutor`, `predictedoractualqualifications`, `entryrequirementsknown`, `specialrequirements`, `interviewnotes`, `subjectchoice`, `enrichment`, `accepted`, `applicant_id`  From applicant";
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
                    <img src="" class="demo-avatar">
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
                    <a class="mdl-navigation__link" href="./admineditform.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">edit</i>Edit Form</a>
                    <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>

                </nav>
            </div>
            <main class="mdl-layout__content mdl-color--grey-100">
                <!-- Admin Controls -->
                <!-- User search -->
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-grid" id="user-search">
                            <div class="mdl-cell mdl-cell--4-col" style="padding-top: 20px;">Search for a user:</div>
                            <div class="mdl-cell mdl-cell--2-col">
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="search-id-input">
                                    <label class="mdl-textfield__label" for="search-id-input">Enter ID</label>
                                    <span class="mdl-textfield__error">Input is not a number!</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--4-col">
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" id="search-username-input">
                                    <label class="mdl-textfield__label" for="search-username-input">Enter username</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--2-col">
                                <button class="mdl-button mdl-js-button mdl-button--raised" id="searchUserBtn">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col" style="border-style: outset;">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--4-col">Display User</div>
                        </div>
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--4-col" id="displayLoginId"></div>
                            <div class="mdl-cell mdl-cell--4-col" id="displayUsername"></div>
                            <div class="mdl-cell mdl-cell--4-col" id="displayType"></div>
                        </div>
                    </div>
                </div>
                <!-- User search -->
                <!-- Applicant search -->
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col" style="border-style: outset;">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--8-col">
                                Applicants
                            </div>
                        </div>
                        <div id="applicantDisplay">
                            <?php
                            $addedHTML = "";
                            $x = 0;
                            while($row = mysqli_fetch_array($result)){
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
                                    
                                $addedHTML .= "
                                <div class='mdl-grid' id='" . $row['fname'] . " " . $row['sname'] . "'>
                                <div class='mdl-cell mdl-cell--12-col'>
                                <button type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab collapsebutton' onclick='switchDisplay(" . $x . ");'>
                                <i class='material-icons' id='collapsebutton" . $x ."'>add</i>
                                </button> " . $row["fname"] . " " . $row["sname"] . " ID: <span id='" . $x . "'>" . $row["applicant_id"] . "</span>
                                <div class='mdl-grid collapse'>";
                                for($i = 0; $i < count($inputNames); $i++){
                                    if ($inputTypes[$i] == "VARCHAR") { //Check the type of data, depending on the type of data there will be a different display
                                        //If type is varchar then create a textfield
                                        $addedHTML .= "
                                        <div class='mdl-cell mdl-cell--6-col'><div class='mdl-textfield mdl-js-textfield  mdl-textfield--floating-label applicationInputs'>
                                        <input class='mdl-textfield__input input-varchar' value='" . $row[$inputNames[$i]] . "' type='text' name='applicant" . $x . "input" . $i . "' id='applicant" . $x . "input" . $i . "' maxlength='" . $inputLengths[$i] . "'>
                                        <label class='mdl-textfield__label' for='applicant" . $x . "input" . $i . "'>" . $inputDisplays[$i] . "</label>
                                        </div></div>";
                                        //The max length is limited to the length of the VARCHAR field
                                        //The display is shown in the label
                                    } else if ($inputTypes[$i] == "ENUM") {
                                        //Split the options variable at the comma to get each option in the table
                                        $options = explode(",", $inputLengths[$i]);
                                        //If the type is enum then create a dropdown mdl-textfield__input
                                        $addedHTML .= "<div class='mdl-grid'><div class='mdl-cell mdl-cell--2-col'>" . $inputDisplays[$i] . "</div><div class='mdl-cell mdl-cell--4-col'><select class='input-enum' name='applicant" . $x . "input" . $i . "'>";
                                        for ($y = 0; $y < count($options); $y++) { //loops for each option
                                            $addedHTML .= ":<option value='" . $options[$y] . "'>" . strtoupper($options[$y]) . "</option>"; //creates an option in the dropdown for each valid answer
                                        }
                                        $addedHTML .= "</select></div></div>";
                                    } else if ($inputTypes[$i] == "BIT") {
                                    //If the type is bit then it creates radio buttons as I use bits where 1 is true and 0 is false
                                        $addedHTML .= "<div class='mdl-grid'><div class='mdl-cell mdl-cell--12-col'>" . $inputDisplays[$i] . "</div></div><div class='mdl-grid'><div class='mdl-cell mdl-cell--4-col'><label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='radioButton" . $i . "-option-1'><input type='radio' id='radioButton" . $i . "-option-1' class='mdl-radio__button' name='applicant" . $x . "input" . $i . "' value='1' checked><span class='mdl-radio__label'>Yes</span></label></div><div class='mdl-cell mdl-cell--4-col'><label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='radioButton" . $i . "-option-2'><input type='radio' id='radioButton" . $i . "-option-2' class='mdl-radio__button' name='options-learningneeds' value='0'><span class='mdl-radio__label'>No</span></label></div></div>";
                                    } else if ($inputTypes[$i] == "YEAR") {
                                        //If the type is year then create a dropdown
                                        //Split at the - as the length will hold the minimum and maximum years
                                        $options = explode("-", $inputLengths[$i]);
                                        //Make sure minYear and maxYear are integers as I use a comparison operator later
                                        $minYear = $options[0];
                                        $maxYear = $options[1];
                                        $currentYear = $minYear;
                                        $addedHTML .= "<div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'>" . $inputDisplays[$i] . "</div><div class='mdl-cell mdl-cell--4-col'><select class='input-enum' name='applicant" . $x . "input" . $i . "'>";
                                        while ($maxYear >= $currentYear) { //Loop for each of the years available
                                            $addedHTML .= ":<option value='" . $currentYear . "'>" . $currentYear . "</option>";
                                            $currentYear += 1;
                                        }
                                    $addedHTML .= "</select></div></div>";
                                    }
                                }
                                
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
                                            <input type='radio' id = 'applicant" . $x . "learningneeds-option-1' class='mdl-radio__button' name = 'applicant" . $x . "options-learningneeds' value='1' checked>
                                            <span class='mdl-radio__label'>Yes</span>
                                        </label>
                                    </div>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for = 'applicant" . $x . "learningneeds-option-2'>
                                            <input type='radio' id = 'applicant" . $x . "learningneeds-option-2' class='mdl-radio__button' name = 'applicant" . $x . "options-learningneeds' value='0' >
                                            <span class='mdl-radio__label'>No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class='mdl-grid'>
                                    <div class='mdl-cell--12-col'>
                                        <!-- Floating Multiline Textfield -->
                                        <div class='mdl-textfield mdl-js-textfield' style='width: 100%;'>
                                            <textarea class='mdl-textfield__input' type='text' rows='3' id = 'applicant" . $x . "learningneedsdetails' name = 'applicant" . $x . "learningNeedsDetails'></textarea>
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
                                        <!-- Floating Multiline Textfield -->
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
                                <!-- Input -->

                                <div class='mdl-grid'>
                                    <div class='mdl-cell mdl-cell--4-col'>
                                        <!-- Raised button with ripple -->
                                        <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' type='submit'>
                                            Send Reference
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                                </div></div></div></div>
                                ";
                                $x++;
                            }
                            
                            echo $addedHTML;
                            ?>
                        </div>
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--4-col">
                                <!-- Accent-colored raised button with ripple -->
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="submit-changes">
                                    Submit changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Applicant search -->
            </main>
        </div>
        <script src="../scripts/loginpage/material.min.js"></script>
        <script src="../scripts/loadUserData.js"></script>
        <script src="../scripts/searchUser.js"></script>
        <script src="../scripts/changeApplicantInfo.js"></script>
        <script type="text/javascript">
            var elements = document.getElementsByClassName("collapse");
            // collapse all sections
            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = "none";
            }

            //collapse or expand depending on state
            function switchDisplay(i) {

                if (elements[i].style.display == "none") {
                    elements[i].style.display = "block";
                    document.getElementById("collapsebutton" + i).innerHTML = "remove";
                } else {
                    elements[i].style.display = "none";
                    document.getElementById("collapsebutton" + i).innerHTML = "add";
                }
                return false;
            }
        </script>
    </body>

    </html>