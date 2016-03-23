<?php
    $tbl_name = "storedinformation";

    require "../connect.php";

    //Get the name of the option the user wants to remove
    $nameOfOption = isset($_POST['nameofinfo']) ? $_POST['nameofinfo'] : '';

    //SQL to delete the option
    $sql ="
    DELETE FROM $tbl_name
    WHERE `name` = '$nameOfOption'
    ";

    mysqli_query($link, $sql) or die(mysql_error());
    
    $sql="
    ALTER TABLE applicant
    DROP COLUMN `$nameOfOption`
    ";
    
    mysqli_query($link, $sql) or die(mysql_error());

?>
