<?php

session_start();  //start session

session_destroy();  //delete all variables in session

header("Location: ../views/index.html");  //go to homepage
?>
