<?php
    $tbl_name = "subject";

    require "./connect.php";

    //Get the name of the option the user wants to remove
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $examboard = isset($_POST['examboard']) ? $_POST['examboard'] : '';

    //SQL to delete the option
    $sql ="
    UPDATE $tbl_name
    SET
    name = '$name',
    exam_board = '$examboard'
    WHERE `subject_id` = '$id'
    ";

    echo $sql;
    mysqli_query($link, $sql) or die(mysqli_error($link));

    mysqli_close($link);

?>
