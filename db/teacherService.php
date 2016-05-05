<?php
require "./connect.php";
session_start();

//sql selects department for teacher
$sql = "SELECT department FROM teacher WHERE login_id = " . $_SESSION['id'];

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$department = $row[0];  //gets value of department for teacher

//sql selects applicant id from selected courses where the applicant has selected a sixth form subject like the teachers department
$sql = "
SELECT applicant_id FROM `selected courses`
INNER JOIN `sixth form subject`
ON sixthformsubject_id = block_a
OR sixthformsubject_id = block_b
OR sixthformsubject_id = block_c
OR sixthformsubject_id = block_d
OR sixthformsubject_id = block_e
WHERE INSTR(name, '$department')
ORDER BY applicant_id ASC
";

$result = mysqli_query($link, $sql);
$applicants = [];
$applicants[0] = "";
$i = 1;
while ($row = mysqli_fetch_array($result)){ //loop through all arrays
  if (!($applicants[($i - 1)] == $row[0])){ //if applicant hasn't been previously selected
    $applicants[$i] = $row[0];  //assign new applicant id
    $i++;
  }
}

$sql = "";
for ($i = 1; $i < count($applicants); $i++){  //loop through all applicants
  //sql selects applicants grades, first name, surname and id
  $sql .= "
  SELECT grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken, subject.name, subject.exam_board, applicant.fname, applicant.sname, applicant.applicant_id
  FROM grades
  INNER JOIN subject
  ON grades.subject_id = subject.subject_id
  INNER JOIN applicant
  ON grades.applicant_id = applicant.applicant_id
  WHERE grades.applicant_id = $applicants[$i];
  ";
}

if ($result = mysqli_multi_query($link, $sql)){ //run all sql queries
        // If so, then create a results array and a temporary one
        // to hold the data
        $resultArray = array();
        $tempArray = array();
    do{
      if ($result = mysqli_store_result($link)) {


        // Loop through each row in the result set
        while($row = mysqli_fetch_object($result)){
                // Add each row into our results array
                $tempArray = $row;
            array_push($resultArray, $tempArray);
        }
        mysqli_free_result($result);

      }
    }while (mysqli_next_result($link));
    // Finally, encode the array to JSON and output the results

    echo json_encode($resultArray);

}

// Close connections
mysqli_close($link);

?>
