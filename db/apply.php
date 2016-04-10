<?php

$length = 20;
$tutorAuthenticator = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);;
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);;

require "./connect.php";

$gradeid = array();

for ($readGrades = 0; $readGrades < 13; $i++){
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
        $sql = "
        SELECT subject_id FROM `subject` 
        WHERE name='$subject' AND exam_board='$examboard'
        ";

        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($result);
        echo $sql;
        echo $row[0];

        $sql = "
        INSERT INTO `grades`(`subject_id`, `predicted_grade`, `mock_result`, `actual_result`, `year_taken`)
        VALUES ('$row[0]', '$predictedgrade', '$mockresult', '$actualresult', '$yeartaken')
        ";
    
        mysqli_query($link, $sql) or die(mysqli_error($link));
        $gradeid[$readGrades] = mysqli_insert_id($link);
    } else {
        $gradeid[$readGrades] = "NULL";
    }
    
}




$sql = "
INSERT INTO `applicant` (gcsetaken1, gcsetaken2, gcsetaken3, gcsetaken4, gcsetaken5, gcsetaken6, gcsetaken7, gcsetaken8, gcsetaken9, gcsetaken10, gcsetaken11, gcsetaken12, gcsetaken13, selectedcourses_id) VALUES ($gradeid[0], $gradeid[1], $gradeid[2], $gradeid[3], $gradeid[4], $gradeid[5], $gradeid[6], $gradeid[7], $gradeid[8], $gradeid[9], $gradeid[10],$gradeid[11], $gradeid[12], )
";

mysqli_query($link, $sql) or die(mysqli_error($link));

$last_id = mysqli_insert_id($link);
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