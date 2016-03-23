<?php
$tbl = "storedinformation";

require "../connect.php";

$name = isset($_POST['name']) ? $_POST['name'] : '';
$name = stripslashes($name);
$name = mysqli_real_escape_string($link, $name);
$name = isset($_POST['name']) ? $_POST['name'] : '';

$sql = "
UPDATE $tbl
SET name='$name'
WHERE name = '$name';
";

$update = mysqli_query($link, $sql);
if ($update){
  $sql = "
  SELECT name
  FROM $tbl
  WHERE name = '$name'
  ";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1){

    $row = mysqli_fetch_assoc($result);
    echo $row['name'];

  }
}else{
  echo "error updating table";
}
?>
