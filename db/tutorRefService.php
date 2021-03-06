<?php
session_start();

require "./connect.php";

$id = $_SESSION["studentid"]; //get students id

// This SQL statement selects the students' name and gcse's from the table
$sql = "
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE grades.applicant_id = '$id'
";

// Check if there are results
if ($result = mysqli_query($link, $sql)){
          // If so, then create a results array and a temporary one
          // to hold the data
          $resultArray = array();
          $tempArray = array();

          // Loop through each row in the result set
          while($row = mysqli_fetch_object($result)){
              // Add each row into our results array
              $tempArray = $row;
              array_push($resultArray, $tempArray);
          }

          // Finally, encode the array to JSON and output the results
          echo json_encode($resultArray);
}

// Close connections
mysqli_close($link);
?>
