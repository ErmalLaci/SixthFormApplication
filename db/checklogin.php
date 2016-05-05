<?php

if (!(isset($_SESSION["username"]) && isset($_SESSION["id"]) && $_SESSION["type"] == $type)){ //check if session username and id are set, and session type is equal to the type of user stored in login page
    header ("Location: ../views/index.html"); //if there is an error go to homepage
}

?>
