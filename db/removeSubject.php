<?php
    $tblName = "subject";

    require "./connect.php";

    //Get the id of the subject the user wants to remove
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    //SQL to delete the option
    $sql ="
    DELETE FROM $tblName
    WHERE `subject_id` = '$id'
    ";

    mysqli_query($link, $sql) or die(mysql_error());

    mysqli_close($link);

?>
