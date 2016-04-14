<?php

$length = 20;
$tutorAuthenticator = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$errorcheck = "";
require "./connect.php";


if (isset($_POST["blockA-options"])){
    $blockA = $_POST["blockA-options"];
    $sql = "
    SELECT `sixthformsubject_id` 
    FROM `sixth form subject`
    WHERE name = '$blockA' AND block = 'A'
    ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $blockAid = $row[0];
} else {
    $blockAid = "NULL";
}
if (isset($_POST["blockB-options"])){
    $blockB = $_POST["blockB-options"];
    $sql = "
    SELECT `sixthformsubject_id` 
    FROM `sixth form subject`
    WHERE name = '$blockB' AND block = 'B'
    ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $blockBid = $row[0];
} else {
    $blockBid = "NULL";
}
if (isset($_POST["blockC-options"])){
    $blockC = $_POST["blockC-options"];
    $sql = "
    SELECT `sixthformsubject_id` 
    FROM `sixth form subject`
    WHERE name = '$blockC' AND block = 'C'
    ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $blockCid = $row[0];
} else {
    $blockCid = "NULL";
}
if (isset($_POST["blockD-options"])){
    $blockD = $_POST["blockD-options"];
    $sql = "
    SELECT `sixthformsubject_id` 
    FROM `sixth form subject`
    WHERE name = '$blockD' AND block = 'D'
    ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $blockDid = $row[0];
} else {
    $blockDid = "NULL";
}
if (isset($_POST["blockE-options"])){
    $blockE = $_POST["blockE-options"];
    $sql = "
    SELECT `sixthformsubject_id` 
    FROM `sixth form subject`
    WHERE name = '$blockE' AND block = 'E'
    ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $blockEid = $row[0];
} else {
    $blockEid = "NULL";
}
if (isset($_POST["level2-options"])){
    $level2 = $_POST["level2-options"];
    $sql = "
    SELECT `sixthformsubject_id` 
    FROM `sixth form subject`
    WHERE name = '$level2' AND level = 'Level 2'
    ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $level2id = $row[0];
} else {
    $level2id = "NULL";
}

$reasons = isset($_POST["courses_reasons-input"]) ? $_POST["courses_reasons-input"] : "";

$sql = "
INSERT INTO `selected courses`(`block_a`, `block_b`, `block_c`, `block_d`, `block_e`, `level2_block`, `courses_reasons`) 
VALUES($blockAid, $blockBid, $blockCid, $blockDid, $blockEid, $level2id, '$reasons')
";

echo $sql;

mysqli_query($link, $sql) or die(mysqli_error($link));

$selectedcourseid = mysqli_insert_id($link);

echo "course id: " . $selectedcourseid;

$sql = "
INSERT INTO `applicant` (selectedcourses_id) VALUES ($selectedcourseid)
";
echo $sql;
mysqli_query($link, $sql) or die(mysqli_error($link));

$last_id = mysqli_insert_id($link);

for ($readGrades = 0; $readGrades < 13; $readGrades++){
    $inputname = "subject-" . $readGrades . "-input";
    $subject = isset($_POST[$inputname]) ? $_POST[$inputname] : "";
    $inputname = "exam_board-" . $readGrades . "-input";
    $examboard = isset($_POST[$inputname]) ? $_POST[$inputname] : "";
    $inputname = "predicted_grade-" . $readGrades . "-input";
    $predictedgrade = isset($_POST[$inputname]) ? $_POST[$inputname] : "";
    $inputname = "mock_result-" . $readGrades . "-input";
    $mockresult = isset($_POST[$inputname]) ? $_POST[$inputname] : "";
    $inputname = "actual_result-" . $readGrades . "-input";
    $actualresult = isset($_POST[$inputname]) ? $_POST[$inputname] : "";
    $inputname = "year_taken-" . $readGrades . "-input";
    $yeartaken = isset($_POST[$inputname]) ? $_POST[$inputname] : "";
    if ($subject == ""||$examboard == ""||$predictedgrade == ""||$mockresult == ""||$yeartaken == ""){
        
    } else {
        $sql = "
        SELECT subject_id FROM `subject` 
        WHERE name='$subject' AND exam_board='$examboard'
        ";

        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        //echo $sql;
        $subjectidsql = $row["subject_id"];
        $sql = "
        INSERT INTO `grades`(`subject_id`, `predicted_grade`, `mock_result`, `actual_result`, `year_taken`, `applicant_id`)
        VALUES ('$subjectidsql', '$predictedgrade', '$mockresult', '$actualresult', '$yeartaken', '$last_id')
        ";
    
        mysqli_query($link, $sql) or die(mysqli_error($link));
    }
    
}

echo 'g';
echo $last_id;

$sql = "
SELECT name
FROM storedinformation
";
//echo $sql;

$result = mysqli_query($link, $sql);
$readInputs= 0;
while ($row = mysqli_fetch_assoc($result)){
  $name = $row["name"];
  $inputNumber = "input" . $readInputs;
  $input = isset($_POST[$inputNumber]) ? $_POST[$inputNumber] : "";
  $sql = "
  UPDATE applicant
  SET $name='$input'
  WHERE applicant_id='$last_id';
  ";
  echo $sql;
  mysqli_query($link, $sql);
  $readInputs++;
}

$sql = "
SELECT fname, sname
FROM applicant
WHERE applicant_id = '$last_id'
";
//echo $sql;

$result = mysqli_query($link, $sql) or die(mysql_error());
$row = mysqli_fetch_assoc($result);
$fname = $row["fname"];
$sname = $row["sname"];
$username = substr("$fname",0,1) . $sname;

$usedUsernames = 1;
$testUsername = $username;
do {
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

$sql = "
INSERT INTO login (username, password, type)
VALUES ('$username', '$password', 'applicant')
";
//echo $sql;

mysqli_query($link, $sql) or die(mysql_error());

$sql = "SELECT login_id FROM login WHERE username = '$username'";

$result = mysqli_query($link, $sql) or die(mysql_error());

$row = mysqli_fetch_assoc($result);
$id = $row["login_id"];

//echo $id;

$sql = "
UPDATE applicant
SET login_id='$id',tutorauthenticator='$tutorAuthenticator'
WHERE applicant_id='$last_id'
";
//echo $sql;

mysqli_query($link, $sql) or die(mysql_error());

$sql = "
SELECT fname, sname, email, tutoremail
FROM applicant
WHERE applicant_id='$last_id'
";
//echo $sql;

$result = mysqli_query($link, $sql) or die(mysql_error());
$row = mysqli_fetch_assoc($result);

$to = $row["tutoremail"];
//echo $to;
//define the subject of the email
$subject = 'Tutor Reference';
//define the message to be sent. Each line should be separated with \n
$message = "Hello, " . $fname . " " . $sname . " recently applied to highdown and set this as their tutors email.\n\nYour teacher authenticator code is: $tutorAuthenticator.";
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: laciermal98@gmail.com\r\n";
$headers .= "Reply-To: laciermal98@gmail.com\r\n";
$headers .= "Return-Path: laciermal98@gmail.com\r\n";
$headers .= "CC: undefinedhawk@live.co.uk\r\n";
$headers .= "BCC: laciermal98@gmail.com\r\n";
//send the email
$mail_sent = mail($to, $subject, $message, $headers);

echo $mail_sent ? "Mail sent" : "Mail failed";



$to = $row["email"];

$sql = "
SELECT username
FROM login
INNER JOIN applicant
ON applicant.login_id=login.login_id
WHERE applicant_id='$last_id'
";
echo $sql;
$result = mysqli_query($link, $sql) or die(mysql_error());
$row = mysqli_fetch_assoc($result);
echo $row["username"];

//echo $to;
//define the subject of the email
$subject = 'Highdown school application';
//define the message to be sent. Each line should be separated with \n
$message = "Hello, " . $fname . " " . $sname . ". We received your application to Highdown School.\n\nYour username is: " . $row["username"] . "\n\nYour password is: " . $password . ". We recommend you change this once you log in however.";
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: laciermal98@gmail.com\r\n";
$headers .= "Reply-To: laciermal98@gmail.com\r\n";
$headers .= "Return-Path: laciermal98@gmail.com\r\n";
$headers .= "CC: undefinedhawk@live.co.uk\r\n";
$headers .= "BCC: laciermal98@gmail.com\r\n";
//send the email
$mail_sent = mail($to, $subject, $message, $headers);

echo $mail_sent ? "Mail sent" : "Mail failed";

//echo "account created";

?>