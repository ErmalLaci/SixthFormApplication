<?php
require "./connect.php";
/*
$sql = " SHOW COLUMNS FROM `teacher` LIKE 'department' ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result , MYSQL_NUM );

$regex = "/'(.*?)'/";
preg_match_all( $regex , $row[1], $enum_array );
$enum_fields = $enum_array[1];
echo json_encode($enum_fields);
*/
$sql = "
SHOW COLUMNS FROM `teacher` LIKE 'department';
SELECT fname, sname, department, username, password, login.login_id
FROM teacher
INNER JOIN login
ON login.login_id = teacher.login_id;
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
    do{
      if ($result = mysqli_store_result($link)) {

        if($x = 0){
          $row = mysqli_fetch_array($result , MYSQL_NUM );

          $regex = "/'(.*?)'/";
          preg_match_all( $regex , $row[1], $enum_array);
          $enum_fields = $enum_array[1];
          array_push($resultArray, $enum_fields);
          mysqli_free_result($result);
        }else{
          // Loop through each row in the result set
          while($row = mysqli_fetch_object($result)){
                  // Add each row into our results array
                  $tempArray = $row;
                array_push($resultArray, $tempArray);
          }

        // Finally, encode the array to JSON and output the results
          mysqli_free_result($result);
        }
      }
      $x++;
      array_push($resultArray, "End");
    }while (mysqli_next_result($link));
    echo json_encode($resultArray);

}

mysqli_close($link);
?>
