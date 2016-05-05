<?php
    session_start();
    $type = "applicant";  //set type as applicant
    require "../db/checkLogin.php";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ApplicantLogin</title>
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
                    <li class="mdl-menu__item">Legal information</li>
                </ul>
            </div>
        </header>
        <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
            <header class="demo-drawer-header">
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
                <a class="mdl-navigation__link" href="./applicantinbox.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
                <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>
            </nav>
        </div>
        <main class="mdl-layout__content mdl-color--grey-100">
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--8-col">
              <div id="displayMyInfo"></div>
            </div>
            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col funky-table">
                  <div>Accepted?</div>
                  <br>
                  <div id="displayAccepted"></div>
                </div>
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col">
                  <form name="changePassword" action="../db/changeApplicantPassword.php" method="POST">
                    <div class="mdl-textfield mdl-js-textfield">
                      <input class="mdl-textfield__input" type="text" id="newPasswordInput" name="newPasswordInput">
                      <label class="mdl-textfield__label" for="newPasswordInput">New Password</label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                      Change Password
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
    </div>
    <script src="../scripts/loginpage/material.min.js"></script>
    <script src="../scripts/loadUserData.js"></script>
    <script src="../scripts/loadApplicantInfo.js"></script>
</body>

</html>
