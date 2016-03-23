<?php
$tbl = "storedinformation";

require "../connect.php";

$length = isset($_POST['length']) ? $_POST['length'] : '';
$length = stripslashes($length);
$length = mysqli_real_escape_string($link, $length);
$name = isset($_POST['name']) ? $_POST['name'] : '';

$sql = "
UPDATE $tbl
SET length='$length'
WHERE name = '$name';
";

$update = mysqli_query($link, $sql);
if ($update){
  $sql = "
  SELECT length
  FROM $tbl
  WHERE name = '$name'
  ";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1){

    $row = mysqli_fetch_assoc($result);
    echo $row['length'];

  }
}else{
  echo "error updating table";
}
?>
