<?php
$tbl = "storedinformation";

require "../connect.php";

$display = isset($_POST['display']) ? $_POST['display'] : '';
$display = stripslashes($display);
$display = mysqli_real_escape_string($link, $display);
$name = isset($_POST['name']) ? $_POST['name'] : '';

$sql = "
UPDATE $tbl
SET display='$display'
WHERE name = '$name';
";
 echo $sql;
$update = mysqli_query($link, $sql);
if ($update){
  $sql = "
  SELECT display
  FROM $tbl
  WHERE name = '$name'
  ";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1){

    $row = mysqli_fetch_assoc($result);
    //echo $row['display'];

  }
}else{
  echo "error updating table";
}
?>
