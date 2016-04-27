<?php
require "./connect.php";

// This SQL statement selects ALL from the storedinformation
$sql = "SELECT * FROM storedinformation; ";
// This SQL statement selects subjects
$sql .= "SELECT * FROM subject;";
// This sql statement selects sixth form subjects
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
