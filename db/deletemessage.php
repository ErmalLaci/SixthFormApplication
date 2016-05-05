<?php
session_start();

require "./connect.php";  //connect to the server

$id = $_SESSION["id"];  //get current user id

$solution = [];
$msgDelete = [];

$msgDeleteInput = isset($_POST["deletedMessages"]) ? $_POST["deletedMessages"] : ""; //gets string which decides which messages should be deleted

$msgDelete = str_split($msgDeleteInput);

$sql = "
SELECT news_id FROM recipient
WHERE login_id=$id
";

$result = mysqli_query($link, $sql);  //select all news the user has recieved


while ($row = mysqli_fetch_assoc($result)){ //loop through all news passing value to $solution array

    $solution[] = $row["news_id"];

}

$length = count($solution);
$currentId = "";

for ($i = 0; $i < $length; $i++){ //loop for all values of solution
    $currentId = $solution[$i];
    if($msgDelete[$i] == "1"){  //check if each character in string is '1', if yes then delete that news
        $sql ="
        DELETE FROM news
        WHERE news_id='$currentId'
        ";
    }
    mysqli_query($link, $sql) or die(mysqli_error()); //deleting from the news table cascades and deletes from the recipient table also
    echo $sql;
}
mysqli_close($link);
?>
