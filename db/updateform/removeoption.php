<?php

    //connect to the server
    require "../connect.php";

    //Get the name of the option the user wants to remove
    $nameOfOption = isset($_POST['nameOfInfo']) ? $_POST['nameOfInfo'] : '';
    $nameOfOption = stripslashes($nameOfOption);
    $nameOfOption = mysqli_real_escape_string($link, $nameOfOption);  //protect against sql injection
    //SQL to delete the option
    $sql ="
    DELETE FROM storedinformation
    WHERE `name` = '$nameOfOption'
    ";

    mysqli_query($link, $sql) or die(mysql_error());

    //sql to remove option from applicant table
    $sql="
    ALTER TABLE applicant
    DROP COLUMN `$nameOfOption`
    ";

    mysqli_query($link, $sql) or die(mysql_error());
    mysqli_close($link);
?>
