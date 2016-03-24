<?php
require "./connect.php";
$tbl_name = "storedinformation";

// This SQL statement selects ALL from the table
$sql = "SELECT * FROM $tbl_name";

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
