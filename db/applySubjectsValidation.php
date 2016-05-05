<?php
require "./connect.php";

$subjects = [];
$examBoards = [];

$subjects = isset($_POST["subjectJson"]) ? json_decode($_POST["subjectJson"]) : ""; //get json strings and turn into arrays
$examBoards = isset($_POST["examBoardJson"]) ? json_decode($_POST["examBoardJson"]) : "";
$applicantId = isset($_POST["applicantId"]) ? $_POST["applicantId"] : "";
$erroneousInputs = [];
$errorMsg = "";

//sql for selecting name and exam board of all grades inputs
$sql = "
SELECT name, exam_board
FROM subject
WHERE name='" . $subjects[0] . "' AND exam_board='" . $examBoards[0] . "'
";
for ($i = 1; $i < 13; $i++){
  $sql .= "
  UNION
  SELECT name, exam_board
  FROM subject
  WHERE name='" . $subjects[$i] . "' AND exam_board='" . $examBoards[$i] . "'
  ";
}

$result = mysqli_query($link, $sql);
$x = 0;
while ($row = mysqli_fetch_array($result)){ //loop through each result array
  for ($i = $x; $i < 13; $i++){ //loop through the results in case there is an error
    if ($row[0] == $subjects[$i] && $row[1] == $examBoards[$i]){  //check if looped subject is equal to selected
      $x = $i;
      $erroneousInputs[$i] = 0;
      break;
    } else {
      $erroneousInputs[$i] = 1;
    }
  }
  $x++;
}

for ($i = 0; $i < count($erroneousInputs); $i++){ //loop through all erroneousInputs
  if ($erroneousInputs[$i] == 1){ //there was an error
    if($subjects[$i] == "" xor $examBoards[$i] == ""){  //check if one of the inputs is empty
      $errorMsg .= "You must input both subject and exam board for option" . ($i + 1) . ". ";
    } else if (!($subjects[$i] == "" && $examBoards[$i] == "")){  //check if both of the inputs have values
      $errorMsg .= "This subject: " . $subjects[$i] . " is not a valid input with this exam board: " . $examBoards[$i] . ". ";
    }
  }
}
if ($x < 13){ //check if $row looped less than 13 times
  for ($i = $x; $i < 13; $i ++){  //loop from $x to 13
    if($subjects[$i] == "" xor $examBoards[$i] == ""){  //check if one of the inputs is empty
      $errorMsg .= "You must input both subject and exam board for option " . ($i + 1) . ". ";
    } else  if (!($subjects[$i] == "" && $examBoards[$i] == "")){ //check if both of the inputs have values
      $errorMsg .= "The subject " . $subjects[$i] . " is not a valid input with this exam board " . $examBoards[$i] . ". ";
    }
  }
}


$uniqueEmail = isset($_POST["uniqueEmail"]) ? $_POST["uniqueEmail"] : ""; //get unique email input

//search for any other applicants with the same email
$sql = "
SELECT applicant_id
FROM applicant
WHERE email = '$uniqueEmail'
";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

if ($row["applicant_id"] == $applicantId){ //check if the same applicant has the email (only matters if email is being updated)

}else if (mysqli_num_rows($result) > 0){  //check if there is more than 0 results
  $errorMsg .= "This email is already in use. ";
}

mysqli_close($link);
echo $errorMsg; //return error

?>
