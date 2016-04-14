<?php
require "./connect.php";

$applicant = [[]];

$sql = "
SELECT grades.applicant_id, grades.predicted_grade, grades.mock_result, grades.actual_result, grades.year_taken, subject.name, subject.exam_board
FROM `grades` 
JOIN subject
ON subject.subject_id = grades.subject_id;
";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result)){
    $ $row[0];
}

$sql = "
SELECT name
FROM storedinformation;
";

$sql = "
SELECT `studentachievements`, `learningneeds`, `learningneedsdetails`, `learningsupport`, `learningsupportdetails`, `statemented`, `statementeddetails`, `specialconsiderations`, `specialconsiderationsdetails`, `freeschoolmeals`, `fnameoftutor`, `snameoftutor`, `predictedoractualqualifications`, `tutorauthenticator`, `selectedcourses_id`, `accepted`
FROM `applicant`
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