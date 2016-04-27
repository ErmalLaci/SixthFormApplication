<?php
session_start();
    $type = "admin";
    require "../db/checklogin.php";
?>
    <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inbox</title>
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
                <span class="mdl-layout-title">Manage Admin/Teacher Accounts</span>
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
                <a class="mdl-navigation__link" href="./adminloginpage.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
                <a class="mdl-navigation__link" href="./admininbox.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
                <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">supervisor_account</i>Manage Admin/Teacher Accounts</a>
                <a class="mdl-navigation__link" href="./admineditform.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">edit</i>Edit Form</a>
                <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>
            </nav>
        </div>
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-grid">
                  <div class="mdl-cell mdl-cell--4-col">
                    <table class="funky-table">
                      <tr><td>
                        Create Administrator
                      </td></tr>
                      <tr><td>
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="createAdminUsername">
                        <label class="mdl-textfield__label" for="createAdminUsername">Username</label>
                      </div>
                    </td></tr>
                    <tr><td>
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="createAdminPassword">
                        <label class="mdl-textfield__label" for="createAdminPassword">Password</label>
                      </div>
                    </td></tr>
                    <tr><td>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="createAdmin();">
                        Create
                      </button>
                    </td></tr>
                    <tr><td>
                      <div id="displayAdminCreationError" class="error"></div>
                    </td></tr>
                  </table>
                  <br>
                  <table class="funky-table">
                    <tr><td>
                    Create Teacher Account
                  </td></tr>
                  <tr><td>
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="createTeacherUsername">
                        <label class="mdl-textfield__label" for="createTeacherUsername">Username</label>
                      </div>
                  </td></tr>
                  <tr><td>
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="createTeacherPassword">
                        <label class="mdl-textfield__label" for="createTeacherPassword">Password</label>
                      </div>
                    </td></tr>
                    <tr><td>
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="createTeacherFname">
                        <label class="mdl-textfield__label" for="createTeacherFname">First Name</label>
                      </div>
                    </td></tr>
                    <tr><td>
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="createTeacherSname">
                        <label class="mdl-textfield__label" for="createTeacherSname">Surname</label>
                      </div>
                    </td></tr>
                    <tr><td>
                      <select id="createTeacherDepartment"></select>
                    </td></tr>
                    <tr><td>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="createTeacher();">
                        Create
                      </button>
                    </td></tr>
                    <tr><td>
                      <div id="displayTeacherCreationError" class="error"></div>
                    </td></tr>
                  </table>
                  <table class="funky-table">
                    <tr><td>
                      Add department
                    </td></tr>
                    <tr><td>
                      <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="addDepartment">
                        <label class="mdl-textfield__label" for="addDepartment">Department</label>
                      </div>
                    </td></tr>
                    <tr><td>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="addDepartment();">
                        Add
                      </button>
                    </td></tr>
                    <tr><td>
                      <div id="addDepartmentError" class="error"></div>
                    </td></tr>
                  </table>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <div id="showTeachers"></div>
                  <div id="updateTeacherError" class="error"></div>
                </div>
                <div class="mdl-cell mdl-cell--4-col">
                  <div id="showAdmins"></div>
                  <div id="updateAdminError" class="error"></div>
                </div>
              </div>
            </div>
        </main>
    </div>
    <script src="../scripts/loginpage/material.min.js"></script>
    <script src="../scripts/createAccount.js"></script>
    <script src="../scripts/loadAccounts.js"></script>
    <script src="../scripts/loadUserData.js"></script>
    <script src="../scripts/updateDeleteAccounts.js"></script>
</body>

</html>
