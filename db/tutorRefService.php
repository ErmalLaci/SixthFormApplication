<?php
session_start();

require "./connect.php";

$id = $_SESSION["studentid"];


/*
SELECT fname, sname
FROM applicant
WHERE applicant_id = '$id';
*/

// This SQL statement selects the students' name and gcse's from the table
$sql = "
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken1 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = '$id'
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken2 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = '$id'
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken3 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = '$id'
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken4 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken5 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken6 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken7 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken8 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken9 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken10 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken11 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken12 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id
UNION
SELECT subject.name, subject.exam_board, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken
FROM `grades`
INNER JOIN applicant ON applicant.gcsetaken13 = grades.grade_id
INNER JOIN subject ON grades.subject_id = subject.subject_id
WHERE applicant.applicant_id = $id;
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
