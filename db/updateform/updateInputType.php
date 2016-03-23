<?php
$tbl = "storedinformation";

require "../connect.php";

$type = isset($_POST['type']) ? $_POST['type'] : '';
$type = stripslashes($type);
$type = mysqli_real_escape_string($link, $type);
$id = $_POST['id'] + 1;

$sql = "
UPDATE $tbl
SET type='$type'
WHERE name = '$name';
";

$update = mysqli_query($link, $sql);
if ($update){
  $sql = "
  SELECT type
  FROM $tbl
  WHERE name = '$name
  ";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1){

    $row = mysqli_fetch_assoc($result);
    echo $row['type'];

  }
}else{
  echo "error updating table";
}
?>
