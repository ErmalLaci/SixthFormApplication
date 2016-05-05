<?php
require "./connect.php";

//sql statement to get all department options
$sql = "
SHOW COLUMNS FROM `teacher` LIKE 'department';
";
//select information about teachers
$sql .= "
SELECT fname, sname, department, username, password, login.login_id
FROM teacher
INNER JOIN login
ON login.login_id = teacher.login_id;
";
//select information about admin
$sql .= "
SELECT username, password, login_id
FROM login
WHERE type='admin';
";


if ($result = mysqli_multi_query($link, $sql)){
        // If so, then create a results array and a temporary one
        // to hold the data
        $resultArray = array();
        $tempArray = array();
        $x = 0;
    do{ //loops through each query
      if ($result = mysqli_store_result($link)) { //transfers result set from last query

        if($x = 0){
          $row = mysqli_fetch_array($result);
          $regex = "/'(.*?)'/";
          preg_match_all( $regex , $row[1], $enumArray);
          $enumFields = $enumArray[1];
          array_push($resultArray, $enumFields);
          mysqli_free_result($result);
        }else{
          // Loop through each row in the result set
          while($row = mysqli_fetch_object($result)){
                  // Add each row into our results array
                  $tempArray = $row;
                array_push($resultArray, $tempArray);
          }

          mysqli_free_result($result);  //free memory used in store_result
        }
      }
      $x++;
      array_push($resultArray, "End");
    }while (mysqli_next_result($link));
    // Finally, encode the array to JSON and output the results
    echo json_encode($resultArray);

}

mysqli_close($link);
?>
