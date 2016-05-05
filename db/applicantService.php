<?php
require "./connect.php";
session_start();  //start a session
$id = $_SESSION["id"];    //get id of current user
$sql = "SELECT name, display FROM `storedinformation`; "; //sql to get custom inputs and display

$result = mysqli_query($link, $sql);

$sql .= "SELECT applicant_id, ";
while ($row = mysqli_fetch_array($result)){  //loop through all names of information stored in storedinformation, to get all custom inputs
  $sql .= "`$row[0]`, ";
}
$sql .= "accepted FROM `applicant` WHERE login_id = $id;";  //this will get all the information the applicant input

//sql for getting all the applicants grades
$sql .= "
SELECT grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken, subject.name, subject.exam_board
FROM grades
INNER JOIN subject
ON grades.subject_id = subject.subject_id
INNER JOIN applicant
ON grades.applicant_id = applicant.applicant_id
WHERE applicant.login_id = $id;
";
//sql for getting the names of subjects the applicant chose to study at sixth form
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

if ($result = mysqli_multi_query($link, $sql)){ //runs all the queries
        // If so, then create a results array and a temporary one
        // to hold the data
        $resultArray = array();
        $tempArray = array();
    do{ //loop through each query
      if ($result = mysqli_store_result($link)) {

        // Loop through each row in the result set
        while($row = mysqli_fetch_object($result)){
                // Add each row into our results array
                $tempArray = $row;
            array_push($resultArray, $tempArray); //store information from all queries
        }

        mysqli_free_result($result);
        array_push($resultArray, "End");  //resuls of each query separated by 'End' string
      }
    }while (mysqli_next_result($link));
    // Finally, encode the array to JSON and output the results
    echo json_encode($resultArray);

}
// Close connections
mysqli_close($link);
?>
