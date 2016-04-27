<?php
    $tbl_name = "subject";

    require "./connect.php";

    //Get the name of the option the user wants to remove
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    //SQL to delete the option
    $sql ="
    DELETE FROM $tbl_name
    WHERE `subject_id` = '$id'
    ";

    mysqli_query($link, $sql) or die(mysql_error());

    mysqli_close($link);

?>
