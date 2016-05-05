<?php

//connect to server
require "../connect.php";

$display = isset($_POST['display']) ? $_POST['display'] : ''; //get all inputs and protect against sql injection
$display = stripslashes($display);
$display = mysqli_real_escape_string($link, $display);
$name = isset($_POST['name']) ? $_POST['name'] : '';
$name = stripslashes($name);
$name = mysqli_real_escape_string($link, $name);
$length = isset($_POST['length']) ? $_POST['length'] : '';
$length = stripslashes($length);
$length = mysqli_real_escape_string($link, $length);
$type = isset($_POST['type']) ? $_POST['type'] : '';
$type = stripslashes($type);
$type = mysqli_real_escape_string($link, $type);
$validation = isset($_POST['validation']) ? $_POST['validation'] : '';
$validation = stripslashes($validation);
$validation = mysqli_real_escape_string($link, $validation);
$originalName = isset($_POST['originalName']) ? $_POST['originalName'] : '';
$originalName = stripslashes($originalName);
$originalName = mysqli_real_escape_string($link, $originalName);
$error = "";


if ($type == "VARCHAR" || $type == "INT"){  //check for different types
  if (!is_numeric($length)){  //check if $length is a number
    $error = "Length must be a number for varchar and int inputs";  //errro if not
  }
  //sql for changing varchar or int column
  $sql = "
  ALTER TABLE `applicant`
  CHANGE $originalName $name $type($length);
  ";
} else if ($type == "ENUM"){
    $choices = explode(",", $length); //split each choice in length into an array
    if (count($choices) < 2) {  //check if there are at least 2 option
      $error = "An enum input requires at least two options"; //display error
    } else {
      $choiceString = ""; //create string to store choices
      for ($i = 0; $i < count($choices) - 1; $i++){ //loop through choices and put them in a valid format for sql
        $choiceString .= "'$choices[$i]', ";
      }
    }
    $choiceString .= "'" . $choices[(count($choices) - 1)] . "'";
    //sql for changing enum column
    $sql = "
    ALTER TABLE `applicant`
    CHANGE $originalName $name $type($choiceString);
    ";
} else if ($type == "TEXT" || $type == "BIT"){
  //sql for changing text and bit column
  $sql = "
  ALTER TABLE `applicant`
  CHANGE $name $name $type;
  ";
} else if ($type == "YEAR"){
    $range = explode("-", $length);//split the range in length into an array
      //sql for changing year column
      $sql = "
      ALTER TABLE `applicant`
      CHANGE $originalName $name $type;
      ";
}

if ($error == ""){  //check if there is no error
  mysqli_query($link, $sql);  //if there is no error run query
  //sql for updating information in table
  $sql = "
  UPDATE `storedinformation`
  SET name='$name', display='$display', type='$type', length='$length', validate='$validation'
  WHERE name = '$originalName';
  ";
  mysqli_query($link, $sql);
  mysqli_close($link);
} else {  //if there is an error display it
  echo $error;
}
?>
