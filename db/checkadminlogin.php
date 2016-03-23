<?php
  if ($_SESSION['connected'] === false){
    header ("Location: ../views/loginfail.html");
  }
?>
