<?php
session_start();

require "./connect.php";

$msg = isset($_POST["msginfo"]) ? $_POST["msginfo"] : "";

$msgname = isset($_POST["msgname"]) ? $_POST["msgname"] : "";

$allRecipients = isset($_POST["allRecipients"]) ? $_POST["allRecipients"] : "";

echo $allRecipients;

$id = $_SESSION['id'];
$username = $_SESSION['username'];

$recipients = explode(", ", $allRecipients);


$msgname = $username . " - " . $msgname;


$sql = "
INSERT INTO News (information, nameofinformation)
VALUES ('$msg', '$msgname')
";

mysqli_query($link, $sql) or die(mysqli_error($link));

$newsid = mysqli_insert_id($link);
$loginid = "";
$name = "";

for ($i = 0; $i < sizeof($recipients); $i++){

    $name = mysqli_real_escape_string($link, $recipients[$i]);

    $sql ="
    SELECT login_id
    FROM login
    WHERE username='$name'
    ";
    echo "$recipients[$i]";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    $row = mysqli_fetch_assoc($result);

    $loginid = $row["login_id"];

    $sql = "
    INSERT INTO recipient (login_id, news_id)
    VALUES ('$loginid', '$newsid')
    ";

    echo $sql;
    mysqli_query($link, $sql) or die(mysqli_error($link));

}
mysqli_close($link);
?>
