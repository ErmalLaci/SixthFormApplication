<?php
$tbl_name = "storedinformation";

//Connect to the server
require "../connect.php";

//Gets the values in the table
$nameOfOption = isset($_POST['addOptionName']) ? $_POST['addOptionName'] : '';
$displayOfOption = isset($_POST['addOptionDisplay']) ? $_POST['addOptionDisplay'] : '';
$typeOfOption = isset($_POST['addOptionType']) ? $_POST['addOptionType'] : '';
$lengthOfOption = isset($_POST['addOptionLength']) ? $_POST['addOptionLength'] : '';
//echo $nameOfOption . $typeOfOption . $lengthOfOption;
    
$typeOfOption = strtoupper($typeOfOption);

//SQL to add an option to stored information table

$sql ="
INSERT INTO `$tbl_name` (`name`, `type`, `length`, display)
VALUES ('$nameOfOption', '$typeOfOption', '$lengthOfOption', '$displayOfOption') 
";
//echo $sql;
mysqli_query($link, $sql) or die(mysql_error());
if ($typeOfOption == "VARCHAR"){
    $sql = "
    ALTER TABLE applicant
    ADD `$nameOfOption` $typeOfOption($lengthOfOption) NOT NULL
    ";
}else if($typeOfOption == "INT"){
    $sql = "
    ALTER TABLE applicant
    ADD `$nameOfOption` $typeOfOption($lengthOfOption) NOT NULL
    ";   
}
    

echo $sql;
mysqli_query($link, $sql);
//Go back to edit form page after editing table
header ("Location: ../../views/admineditform.php");

?>