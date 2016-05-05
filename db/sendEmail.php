<?php
require "./connect.php";

$length = 10;
$randomPassword = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$randomHashedPassword = password_hash($randompassword, PASSWORD_BCRYPT);

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$email = stripslashes($email);
$email = mysqli_real_escape_string($link, $email);  //protect against sql injection

//sql for updating email in login using email
$sql = "
UPDATE login
INNER JOIN applicant
ON applicant.login_id=login.login_id
SET password = '$randomHashedPassword'
WHERE applicant.email='$email'
;";

$result = mysqli_query($link, $sql);
if(mysqli_affected_rows($link) == 0){ //check if no rows were affected
    echo "There is no account linked to this email.";
} else {
    //define the receiver of the email
    $to = $email;
    //define the subject of the email
    $subject = 'Password reset request';
    //define the message to be sent. Each line should be separated with \n
    $message = "Hello, you requested a new password. We suggest changing your password after you login.\n\nYour randomly generated password is: $randomPassword.";
    //define the headers we want passed. Note that they are separated with \r\n
    $headers = "From: laciermal98@gmail.com\r\nReply-To: laciermal98@gmail.com";
    //send the email
    $mailSent = @mail( $to, $subject, $message, $headers );
    //if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
}
mysqli_close($link);
?>
