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
        <title>Admin Home</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../style/loginpage/material.min.css">
        <link rel="stylesheet" href="../style/loginpage/styles.css">
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
                    <a class="mdl-navigation__link" href="./admininbox.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
                    <a class="mdl-navigation__link" href="./admineditform.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">edit</i>Edit Form</a>
                    <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>

                </nav>
            </div>
            <main class="mdl-layout__content mdl-color--grey-100">
                <!-- Admin Controls -->
                <!-- User search -->
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-grid" id="user-search">
                            <div class="mdl-cell mdl-cell--4-col" style="padding-top: 20px;">Search for a user:</div>
                            <div class="mdl-cell mdl-cell--2-col">
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="search-id-input">
                                    <label class="mdl-textfield__label" for="search-id-input">Enter ID</label>
                                    <span class="mdl-textfield__error">Input is not a number!</span>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--4-col">
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" id="search-username-input">
                                    <label class="mdl-textfield__label" for="search-username-input">Enter username</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--2-col">
                                <button class="mdl-button mdl-js-button mdl-button--raised" id="searchUserBtn">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col" style="border-style: outset;">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--4-col">Display User</div>
                        </div>
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--4-col" id="displayLoginId"></div>
                            <div class="mdl-cell mdl-cell--4-col" id="displayUsername"></div>
                            <div class="mdl-cell mdl-cell--4-col" id="displayType"></div>
                        </div>
                    </div>
                </div>
                <!-- User search -->
                <!-- Applicant search -->
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col" style="border-style: outset;">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--8-col">
                                Applicants
                            </div>
                        </div>
                        <div id="applicantDisplay">

                        </div>
                    </div>
                </div>
                <!-- Applicant search -->
            </main>
        </div>
        <script src="../scripts/loginpage/material.min.js"></script>
        <script src="../scripts/loadUserData.js"></script>
        <script src="../scripts/loadApplicants.js"></script>
        <script src="../scripts/searchUser.js"></script>
    </body>

    </html>