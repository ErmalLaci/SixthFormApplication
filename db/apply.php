<?php

$length = 20;
$tutorAuthenticator = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);;
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);;

require "./connect.php";

$sql = "
INSERT INTO `applicant` () VALUES ()
";
//echo $sql;

mysqli_query($link, $sql) or die(mysql_error());

$last_id = mysqli_insert_id($link);

//echo $last_id;

$sql = "
SELECT name
FROM storedinformation
";
//echo $sql;

$result = mysqli_query($link, $sql);
$i = 0;
while ($row = mysqli_fetch_assoc($result)){
  $name = $row["name"];
  $inputNumber = "input" . $i;
  $input = isset($_POST[$inputNumber]) ? $_POST[$inputNumber] : "";
  $sql = "
  UPDATE applicant
  SET $name='$input'
  WHERE applicant_id='$last_id';
  ";
  echo $sql;
  mysqli_query($link, $sql);
  $i++;
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
SET login_id='$id'
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
$mail_sent = mail($to, $subject, $message, $headers );

echo $mail_sent ? "Mail sent" : "Mail failed";

$to = $row["email"];
//echo $to;
//define the subject of the email
$subject = 'Highdown school application';
//define the message to be sent. Each line should be separated with \n
$message = "Hello, " . $fname . " " . $sname . ". We received your application to Highdown School.\n\nYour username is: " . $tutorAuthenticator . "\n\nYour password is: " . $password . ". We recommend you change this once you log in however.";
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: laciermal98@gmail.com\r\n";
$headers .= "Reply-To: laciermal98@gmail.com\r\n";
$headers .= "Return-Path: laciermal98@gmail.com\r\n";
$headers .= "CC: undefinedhawk@live.co.uk\r\n";
$headers .= "BCC: laciermal98@gmail.com\r\n";
//send the email
$mail_sent = mail($to, $subject, $message, $headers );

echo $mail_sent ? "Mail sent" : "Mail failed";

//echo "account created";


?>
