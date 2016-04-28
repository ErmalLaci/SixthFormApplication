<?php
    session_start();
    $type = "teacher";
    require "../db/checklogin.php";
?>
    <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../style/loginpage/material.min.css">
    <link rel="stylesheet" href="../style/loginpage/styles.css">
    <link rel="stylesheet" href="../style/stylesheet.css">

</head>

<body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">Home</span>
                <div class="mdl-layout-spacer"></div>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                    <li class="mdl-menu__item">About</li>
                    <li class="mdl-menu__item">Contact</li>
                </ul>
            </div>
        </header>
        <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
            <header class="demo-drawer-header">
                <img src="" class="demo-avatar">
                <div class="demo-avatar-dropdown">
                    <span>
                            <span id="displayusername"></span>
                    <br>
                    <span id="display-usertype"></span>
                    </span>
                    <div class="mdl-layout-spacer"></div>
                </div>
            </header>
            <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
                <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
                <a class="mdl-navigation__link" href="./teacherinbox.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
                <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>

            </nav>
        </div>
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--10-col">
                <!-- Info -->
                <div id="students"></div>
              </div>
            </div>
        </main>
    </div>
    <script src="../scripts/loginpage/material.min.js"></script>
    <script src="../scripts/loadUserData.js"></script>
    <script src="../scripts/loadTeacherDisplay.js"></script>
    <script>
    var elements = document.getElementsByClassName("collapse");
    // collapse all sections
    function hide(){
      for (var i = 0; i < elements.length; i++){
        elements[i].style.display = "none";
        console.log(i);
      }
    }
    //collapse or expand depending on state
    function switchDisplay(i) {
      if (elements[i].style.display == "none"){
        elements[i].style.display = "block";
        document.getElementById("collapsebutton" + i).innerHTML = "remove";
      } else {
        elements[i].style.display = "none";
        document.getElementById("collapsebutton" + i).innerHTML = "add";
      }
      return false;
    }
    </script>
</body>

</html>
