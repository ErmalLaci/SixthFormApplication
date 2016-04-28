<?php
require "./connect.php";
session_start();
$id = $_SESSION["id"];
$sql = "SELECT name, display FROM `storedinformation`; ";

$result = mysqli_query($link, $sql);

$sql .= "SELECT applicant_id";
while ($row = mysqli_fetch_array($result)){
  $sql .= ", `$row[0]`";
}
$sql .= " FROM `applicant` WHERE login_id = $id;";
$sql .= "
SELECT grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken, subject.name, subject.exam_board
FROM grades
INNER JOIN subject
ON grades.subject_id = subject.subject_id
INNER JOIN applicant
ON grades.applicant_id = applicant.applicant_id
WHERE applicant.login_id = $id;
";
$sql .= "
SELECT name, level
FROM `sixth form subject`
INNER JOIN `selected courses`
ON `sixth form subject`.sixthformsubject_id = `selected courses`.block_a
OR `sixth form subject`.sixthformsubject_id = `selected courses`.block_b
OR `sixth form subject`.sixthformsubject_id = `selected courses`.block_c
OR `sixth form subject`.sixthformsubject_id = `selected courses`.block_d
OR `sixth form subject`.sixthformsubject_id = `selected courses`.block_e
OR `sixth form subject`.sixthformsubject_id = `selected courses`.level2_block
INNER JOIN `applicant`
ON `selected courses`.applicant_id = `applicant`.applicant_id
WHERE applicant.login_id = $id;
";

if ($result = mysqli_multi_query($link, $sql)){
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

        // Finally, encode the array to JSON and output the results
        mysqli_free_result($result);
        array_push($resultArray, "End");
      }
    }while (mysqli_next_result($link));
    echo json_encode($resultArray);

}
// Close connections
mysqli_close($link);
?>
