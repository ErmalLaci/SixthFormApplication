<?php

if (!(isset($_SESSION["username"]) && isset($_SESSION["id"]) && $_SESSION["type"] == $type)){
    header ("Location: ../views/loginfail.html");
    /*
    echo $_SESSION["username"];
    echo $_SESSION["id"];
    echo $_SESSION["type"];
    */
}

?>