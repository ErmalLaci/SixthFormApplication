<?php

//Connect to the server
require "../connect.php";

//Gets the values in the table
$nameOfOption = isset($_POST['addOptionName']) ? $_POST['addOptionName'] : '';  //get values
$nameOfOption = stripslashes($nameOfOption);
$nameOfOption = mysqli_real_escape_string($link, $nameOfOption);  //protect against sql injection
$displayOfOption = isset($_POST['addOptionDisplay']) ? $_POST['addOptionDisplay'] : '';
$displayOfOption = stripslashes($displayOfOption);
$displayOfOption = mysqli_real_escape_string($link, $displayOfOption);  //protect against sql injection
$typeOfOption = isset($_POST['addOptionType']) ? $_POST['addOptionType'] : '';
$typeOfOption = stripslashes($typeOfOption);
$typeOfOption = mysqli_real_escape_string($link, $typeOfOption);  //protect against sql injection
$lengthOfOption = isset($_POST['addOptionLength']) ? $_POST['addOptionLength'] : '';
$lengthOfOption = stripslashes($lengthOfOption);
$lengthOfOption = mysqli_real_escape_string($link, $lengthOfOption);  //protect against sql injection
$validationOfOption = isset($_POST['addOptionValidate']) ? $_POST['addOptionValidate'] : '';
$validationOfOption = stripslashes($validationOfOption);
$validationOfOption = mysqli_real_escape_string($link, $validationOfOption);  //protect against sql injection

$typeOfOption = strtoupper($typeOfOption);

//SQL to add an option to stored information table
$sql ="
INSERT INTO `storedinformation` (`name`, `type`, `length`, `display`, `validate`)
VALUES ('$nameOfOption', '$typeOfOption', '$lengthOfOption', '$displayOfOption', '$validationOfOption')
";
//echo $sql;
mysqli_query($link, $sql) or die(mysql_error());
if ($typeOfOption == "VARCHAR" || $typeOfOption == "INT"){  //Edit alter table sql depending on type of input
    $sql = "
    ALTER TABLE applicant
    ADD `$nameOfOption` $typeOfOption($lengthOfOption) NOT NULL
    ";
}else if ($type == "ENUM"){
  $choices = explode(",", $length); //split each choice in length into an array
  $choiceString = "";
  for ($i = 0; $i < count($choices) - 1; $i++){ //loop through each choice adding to string, except last one
    $choiceString .= "'$choices[$i]', ";
  }
  $choiceString .= "'" . $choices[(count($choices) - 1)] . "'"; //add last choice to string
  $sql = "
  ALTER TABLE `applicant`
  CHANGE $name $name $type($choiceString);
  ";
} else if ($type == "TEXT" || $type == "BIT" || $type == "YEAR"){
  $sql = "
  ALTER TABLE `applicant`
  CHANGE $name $name $type;
  ";
}

mysqli_query($link, $sql);
mysqli_close($link);
//Go back to edit form page after editing table
header ("Location: ../../views/admineditform.php");

?>
