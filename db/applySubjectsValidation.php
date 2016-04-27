<?php
require "./connect.php";

$subjects = [];
$examboards = [];

$subjects = isset($_POST["subjectjson"]) ? json_decode($_POST["subjectjson"]) : "";
$examboards = isset($_POST["examboardjson"]) ? json_decode($_POST["examboardjson"]) : "";
$applicant_id = isset($_POST["applicant_id"]) ? $_POST["applicant_id"] : "";
$erroneousInputs = [];
$errorMsg = "";

$sql = "
SELECT name, exam_board
FROM subject
WHERE name='" . $subjects[0] . "' AND exam_board='" . $examboards[0] . "'
";
for ($i = 1; $i < 13; $i++){
  $sql .= "
  UNION
  SELECT name, exam_board
  FROM subject
  WHERE name='" . $subjects[$i] . "' AND exam_board='" . $examboards[$i] . "'
  ";
}

$result = mysqli_query($link, $sql);
$x = 0;
while ($row = mysqli_fetch_array($result)){ //loop through each result array
//echo " x = " . $x;
  for ($i = $x; $i < 13; $i++){ //loop through the results in case there is an error

    if ($row[0] == $subjects[$i] && $row[1] == $examboards[$i]){

      $x = $i;
      //echo " i = " . $i;

      $erroneousInputs[$i] = 0;
      //echo " error : " . $erroneousInputs[$i];
      break;
    } else {
      $erroneousInputs[$i] = 1;
      //echo " error : " . $erroneousInputs[$i];

    }

  }

  $x++;

}

//echo implode(" ", $erroneousInputs);
for ($i = 0; $i < count($erroneousInputs); $i++){
  if ($erroneousInputs[$i] == 1){
    if($subjects[$i] == "" xor $examboards[$i] == ""){
      $errorMsg .= "You must input both subject and exam board for option" . ($i + 1) . ". ";
    } else if (!($subjects[$i] == "" && $examboards[$i] == "")){
      $errorMsg .= "This subject: " . $subjects[$i] . " is not a valid input with this exam board: " . $examboards[$i] . ". ";
    }
  }
}
if ($x < 13){
  $badInputs = 13 - $x;
  for ($i = $x; $i < 13; $i ++)
  if($subjects[$i] == "" xor $examboards[$i] == ""){
    $errorMsg .= "You must input both subject and exam board for option " . ($i + 1) . ". ";
  } else  if (!($subjects[$i] == "" && $examboards[$i] == "")){
    $errorMsg .= "The subject " . $subjects[$i] . " is not a valid input with this exam board " . $examboards[$i] . ". ";
  }
}


$uniqueEmail = isset($_POST["uniqueEmail"]) ? $_POST["uniqueEmail"] : "";

$sql = "
SELECT applicant_id, email
FROM applicant
WHERE email = '$uniqueEmail'
";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

if ($row["applicant_id"] == $applicant_id){

}else if (mysqli_num_rows($result) > 0){
  $errorMsg .= "This email is already in use. ";
}
mysqli_close($link);
echo $errorMsg;

?>
