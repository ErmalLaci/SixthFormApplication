<?php
require "./connect.php";
session_start();
$sql = "SELECT department FROM teacher WHERE login_id = $_SESSION['id']";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$department = $row[0];

$sql = "
SELECT applicant_id FROM `selected courses`
INNER JOIN `sixth form subject`
ON sixthformsubject_id = block_a
OR sixthformsubject_id = block_b
OR sixthformsubject_id = block_c
OR sixthformsubject_id = block_d
OR sixthformsubject_id = block_e
WHERE name = '$department'
";
$result = mysqli_query($link, $sql);
$applicants = [];
$i = 0;
while ($row = mysqli_fetch_array($result)){
  $applicant[$i] = $row[0];
  $i++;
}

$department = $row[0];

$sql .= "SELECT * FROM subject;";
$sql .= "SELECT * FROM `sixth form subject`";
// Check if there are results
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

      }
      array_push($resultArray, "End");
    }while (mysqli_next_result($link));
    echo json_encode($resultArray);

}

// Close connections
mysqli_close($link);
?>
