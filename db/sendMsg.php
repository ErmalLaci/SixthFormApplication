<?php
session_start();

require "./connect.php";

$msg = isset($_POST["msginfo"]) ? $_POST["msginfo"] : ""; //get inputs
$msg = stripslashes($msg);
$msg = mysqli_real_escape_string($link, $msg);  //protect against sql injection
$msgName = isset($_POST["msgName"]) ? $_POST["msgName"] : "";
$msgName = stripslashes($msgName);
$msgName = mysqli_real_escape_string($link, $msgName);  //protect against sql injection
$allRecipients = isset($_POST["allRecipients"]) ? $_POST["allRecipients"] : "";
$allRecipients = stripslashes($allRecipients);
$allRecipients = mysqli_real_escape_string($link, $allRecipients);  //protect against sql injection
if ($allRecipients != ""){  //check if all recipients is not empty
  $recipients = explode(", ", $allRecipients);  //split up all recipients into array and remove commas
} else {
  $recipients = []; //if empty declare recipients as asn empty array
}
$error = "";

if (count($recipients) > 0){  //check if there are any recipients
  for ($i = 0; $i < count($recipients); $i++){  //loop through all recipients

    $name = mysqli_real_escape_string($link, $recipients[$i]);
    $sql = "
    SELECT login_id
    FROM login
    WHERE username='$name'
    ";
    $searchForUserResult = mysqli_query($link, $sql);
    if (mysqli_num_rows($searchForUserResult) < 1){ //check if username exists
      $error .= "Invalid recipient: $name. ";
    }
  }
} else {
  $error .= "You must enter a recipient";
}

if ($error == ""){  //check if there is an error
  $sql = "
  INSERT INTO News (information, nameofinformation)
  VALUES ('$msg', '$msgName')
  ";
  mysqli_query($link, $sql) or die(mysqli_error($link));  //insert news
  $newsId = mysqli_insert_id($link);

  for ($i = 0; $i < count($recipients); $i++){  //loop through recipients

    $name = mysqli_real_escape_string($link, $recipients[$i]);

    $row = mysqli_fetch_assoc($searchForUserResult);
    $loginId = $row["login_id"];

    $sql = "
    INSERT INTO recipient (login_id, news_id)
    VALUES ('$loginId', '$newsId')
    ";

    mysqli_query($link, $sql) or die(mysqli_error($link));  //insert login id and news id to link the two
  }
}
echo $error;
mysqli_close($link);
?>
