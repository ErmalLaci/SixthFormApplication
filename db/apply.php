<?php

$length = 20;
$tutorAuthenticator = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);  //generate a random tutor autheticator and password
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$encryptedPassword = password_hash($password, PASSWORD_BCRYPT); //encrypt the password
require "./connect.php";  //connect to the server


    $blockA = $_POST["blockA-options"];
    //sql for getting id of block a subject
    $selectCourseSql = "
    SELECT `sixthformsubject_id`
    FROM `sixth form subject`
    WHERE name = '$blockA' AND block = 'A'
    ";
    $result = mysqli_query($link, $selectCourseSql);
    $row = mysqli_fetch_array($result);
    $blockAId = $row[0];    //get id

    //sql for getting id of block b subject
    $blockB = $_POST["blockB-options"];
    $selectCourseSql = "
    SELECT `sixthformsubject_id`
    FROM `sixth form subject`
    WHERE name = '$blockB' AND block = 'B'
    ";
    $result = mysqli_query($link, $selectCourseSql);
    $row = mysqli_fetch_array($result);
    $blockBId = $row[0];  //get id

    //sql for getting id of block c subject
    $blockC = $_POST["blockC-options"];
    $selectCourseSql = "
    SELECT `sixthformsubject_id`
    FROM `sixth form subject`
    WHERE name = '$blockC' AND block = 'C'
    ";
    $result = mysqli_query($link, $selectCourseSql);
    $row = mysqli_fetch_array($result);
    $blockCId = $row[0];    //get id

    //sql for getting id of block d subject
    $blockD = $_POST["blockD-options"];
    $selectCourseSql = "
    SELECT `sixthformsubject_id`
    FROM `sixth form subject`
    WHERE name = '$blockD' AND block = 'D'
    ";
    $result = mysqli_query($link, $selectCourseSql);
    $row = mysqli_fetch_array($result);
    $blockDId = $row[0];    //get id

    //sql for getting id of block e subject
    $blockE = $_POST["blockE-options"];
    $selectCourseSql = "
    SELECT `sixthformsubject_id`
    FROM `sixth form subject`
    WHERE name = '$blockE' AND block = 'E'
    ";
    $result = mysqli_query($link, $selectCourseSql);
    $row = mysqli_fetch_array($result);
    $blockEId = $row[0];    //get id

if (isset($_POST["level2-options"])){ //check if level 2 option is set
    $level2 = $_POST["level2-options"];

    //sql for getting id of level 2 subject
    $selectCourseSql = "
    SELECT `sixthformsubject_id`
    FROM `sixth form subject`
    WHERE name = '$level2' AND level = 'Level 2'
    ";
    $result = mysqli_query($link, $selectCourseSql);
    $row = mysqli_fetch_array($result);
    $level2Id = $row[0];    //get id
} else {
    $level2Id = "NULL"; //if not set then set level2id to null
}

$reasons = isset($_POST["courses_reasons-input"]) ? $_POST["courses_reasons-input"] : ""; //get reasons input
$reasons = stripslashes($reasons);
$reasons = mysqli_real_escape_string($link, $reasons);  //protect against sql injection

//insert empty row into applicant
$sql = "
INSERT INTO `applicant` () VALUES ()
";
mysqli_query($link, $sql) or die(mysqli_error($link));

$lastId = mysqli_insert_id($link); //get applicant id

//insert the courses with the applicants id
$selectCourseSql = "
INSERT INTO `selected courses`(`applicant_id`, `block_a`, `block_b`, `block_c`, `block_d`, `block_e`, `level2_block`, `courses_reasons`)
VALUES($lastId, $blockAId, $blockBId, $blockCId, $blockDId, $blockEId, $level2Id, '$reasons')
";
mysqli_query($link, $selectCourseSql) or die(mysqli_error($link));


for ($readGrades = 0; $readGrades < 13; $readGrades++){ //loop through all grades
    $inputName = "subject-" . $readGrades . "-input";
    $subject = isset($_POST[$inputName]) ? $_POST[$inputName] : ""; //get input grades
    $subject = stripslashes($subject);
    $subject = mysqli_real_escape_string($link, $subject);  //protect against sql injection

    $inputName = "exam_board-" . $readGrades . "-input";
    $examBoard = isset($_POST[$inputName]) ? $_POST[$inputName] : "";
    $examBoard = stripslashes($examBoard);
    $examBoard = mysqli_real_escape_string($link, $examBoard);  //protect against sql injection

    $inputName = "predicted_grade-" . $readGrades . "-input";
    $predictedGrade = isset($_POST[$inputName]) ? $_POST[$inputName] : "";
    $predictedGrade = stripslashes($predictedGrade);
    $predictedGrade = mysqli_real_escape_string($link, $predictedGrade);  //protect against sql injection

    $inputName = "mock_result-" . $readGrades . "-input";
    $mockResult = isset($_POST[$inputName]) ? $_POST[$inputName] : "";
    $mockResult = stripslashes($mockResult);
    $mockResult = mysqli_real_escape_string($link, $mockResult);  //protect against sql injection

    $inputName = "actual_result-" . $readGrades . "-input";
    $actualResult = isset($_POST[$inputName]) ? $_POST[$inputName] : "";
    $actualResult = stripslashes($actualResult);
    $actualResult = mysqli_real_escape_string($link, $actualResult);  //protect against sql injection

    $inputName = "year_taken-" . $readGrades . "-input";
    $yearTaken = isset($_POST[$inputName]) ? $_POST[$inputName] : "";
    $yearTaken = stripslashes($yearTaken);
    $yearTaken = mysqli_real_escape_string($link, $yearTaken);  //protect against sql injection

    if ($subject == ""||$examBoard == ""||$predictedGrade == ""||$yearTaken == ""){ //check if any of the required fields are empty

    } else {
        //get id for the subject and exam board and insert it into the grades table
        $sql = "
        SELECT subject_id FROM `subject`
        WHERE name='$subject' AND exam_board='$examBoard'
        ";

        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        $subjectId = $row["subject_id"];
        $sql = "
        INSERT INTO `grades`(`subject_id`, `predicted_grade`, `mock_result`, `actual_result`, `year_taken`, `applicant_id`)
        VALUES ('$subjectId', '$predictedGrade', '$mockResult', '$actualResult', '$yearTaken', '$lastId')
        ";
        mysqli_query($link, $sql) or die(mysqli_error($link));
    }

}

// get name of all the custom inputs
$sql = "
SELECT name
FROM storedinformation
";

$result = mysqli_query($link, $sql);
$readInputs= 0;
while ($row = mysqli_fetch_assoc($result)){ //loop through all results
  $name = $row["name"];
  $inputNumber = "input" . $readInputs;
  $input = isset($_POST[$inputNumber]) ? $_POST[$inputNumber] : ""; //get value of input
  $input = stripslashes($input);
  $input = mysqli_real_escape_string($link, $input);  //protect against sql injection

  //update empty applicant row with all inputs
  $sql = "
  UPDATE applicant
  SET $name='$input'
  WHERE applicant_id='$lastId';
  ";
  //echo $sql;
  mysqli_query($link, $sql);
  $readInputs++;
}

//get applicants first name and surname
$sql = "
SELECT fname, sname
FROM applicant
WHERE applicant_id = '$lastId'
";

$result = mysqli_query($link, $sql) or die(mysql_error());
$row = mysqli_fetch_assoc($result);
$fname = $row["fname"];
$sname = $row["sname"];
$username = substr("$fname",0,1) . $sname;  //use the first letter of the applicants first name and entire surname to create a username

$usedUsernames = 1;
$testUsername = $username;
do {  //loop through username adding 1 until there are no copies of this username
  $sql = "
  SELECT login_id
  FROM login
  WHERE username='$testUsername'
  ";

  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);
  if ($count > 0){
    $usedUsernames++;
    $testUsername = $username . $usedUsernames;
  }
} while ($count > 0);

$username = $testUsername;

//insert username and encrypted password into login
$sql = "
INSERT INTO login (username, password, type)
VALUES ('$username', '$encryptedPassword', 'applicant')
";

mysqli_query($link, $sql) or die(mysql_error());

$sql = "SELECT login_id FROM login WHERE username = '$username'"; //get login id

$result = mysqli_query($link, $sql) or die(mysql_error());

$row = mysqli_fetch_assoc($result);
$id = $row["login_id"];

//update applicant with the applicants login id and tutor authenticator
$sql = "
UPDATE applicant
SET login_id='$id',tutorauthenticator='$tutorAuthenticator'
WHERE applicant_id='$lastId'
";

mysqli_query($link, $sql) or die(mysql_error());

$sql = "
SELECT fname, sname, email, tutoremail
FROM applicant
WHERE applicant_id='$lastId'
";

$result = mysqli_query($link, $sql) or die(mysql_error());
$row = mysqli_fetch_assoc($result); //get information needed for sending emails

$to = $row["tutoremail"];
//define the subject of the email
$subject = 'Tutor Reference';
//define the message to be sent. Each line should be separated with \n
$message = "Hello, " . $fname . " " . $sname . " recently applied to Highdown Sixth Form and set this as their tutors email.\n\nYour tutor authenticator code is: $tutorAuthenticator. Please visit the following link to complete your tutor reference:
http://localhost/SixthFormApplication/views/tutorreference.php?id=$lastId";
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: HighdownSixthFormApplication@reading.sch.uk\r\n";
$headers .= "Reply-To: HighdownSixthFormApplication@reading.sch.uk\r\n";
$headers .= "Return-Path: HighdownSixthFormApplication@reading.sch.uk\r\n";

//send the email to the applicants tutor
$mailSent = mail($to, $subject, $message, $headers);




$to = $row["email"];

$sql = "
SELECT username
FROM login
INNER JOIN applicant
ON applicant.login_id=login.login_id
WHERE applicant_id='$lastId'
";
//get username to send to applicant
$result = mysqli_query($link, $sql) or die(mysql_error());
$row = mysqli_fetch_assoc($result);

//define the subject of the email
$subject = 'Highdown school application';
//define the message to be sent. Each line should be separated with \n
$message = "Hello, " . $fname . " " . $sname . ". We received your application to Highdown Sixth Form.\n\nYour username is: " . $row["username"] . "\n\nYour password is: " . $password . ". We recommend you change this once you log in however.";
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: HighdownSixthFormApplication@reading.sch.uk\r\n";
$headers .= "Reply-To: HighdownSixthFormApplication@reading.sch.uk\r\n";
$headers .= "Return-Path: HighdownSixthFormApplication@reading.sch.uk\r\n";
//send the email to the applicant
$mailSent = mail($to, $subject, $message, $headers);

mysqli_close($link);
header ("Location: ../views/index.html");

?>
