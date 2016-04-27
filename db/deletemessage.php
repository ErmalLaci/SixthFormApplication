<?php
session_start();

require "./connect.php";

$id = $_SESSION["id"];

$solution = array();

$msgdelete = isset($_POST["deletedmessages"]) ? $_POST["deletedmessages"] : "";

$sql = "
SELECT news_id FROM recipient
WHERE login_id=$id
";

$result = mysqli_query($link, $sql);


while ($row = mysqli_fetch_assoc($result)){

    $solution[] = $row["news_id"];

}

$length = sizeof($solution);

$currentId = "";

for ($i = 0; $i < $length; $i++){
    $currentId = $solution[$i];
    if($msgdelete[$i] == "1"){
        $sql ="
        DELETE FROM news
        WHERE news_id='$currentId'
        ";
    }
    mysqli_query($link, $sql) or die(mysqli_error());
    echo $sql;
}
mysqli_close($link);
?>
