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
                    <span class="mdl-layout-title">Inbox - Ermail</span>
                    <div class="mdl-layout-spacer"></div>
                    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                        <li class="mdl-menu__item">About</li>
                        <li class="mdl-menu__item">Contact</li>
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
                    <a class="mdl-navigation__link" href="./applicantloginpage.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
                    <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
                    <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>
                </nav>
            </div>
            <main class="mdl-layout__content mdl-color--grey-100">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col">
                        <form>
                            <button class="mdl-button mdl-js-button mdl-button mdl-button--colored" id="deletemessagebutton">
                                Delete
                            </button>
                        </form>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <button class="mdl-button mdl-js-button mdl-button mdl-button--colored" id="composemessagebutton" onclick="composeMessageFunction();">
                            Compose Message
                        </button>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div id="News" class="mdl-cell mdl-cell--4-col"></div>
                    <div id="displaySelectedMessage" class="mdl-cell mdl-cell--6-col">
                        <div id="messagescomposedivs">
                            <div class="mdl-grid" style="height: 10%">
                                <div class="mdl-cell mdl-cell--4-col">
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" id="messageRecipientInput" onkeyup="addRecipientsFunction(this.value)">
                                        <label class="mdl-textfield__label" for="messageRecipientInput">Send to...</label>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--4-col" id="displayAllRecipients"></div>
                            </div>
                            <div class="mdl-grid" style="height: 10%">
                                <div class="mdl-cell mdl-cell-8-col">
                                    <!-- Simple Textfield -->
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" id="msgname">
                                        <label class="mdl-textfield__label" for="msgname">RE</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--8-col" style="width: 100%;">
                                    <!-- Floating Multiline Textfield -->
                                    <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
                                        <textarea class="mdl-textfield__input" type="text" rows="15" id="msginfo"></textarea>
                                        <label class="mdl-textfield__label" for="msginfo">Text lines...</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--2-col">
                                    <!-- Raised button -->
                                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit" id="sendMsgBtn">
                                        Send
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id='messagesdisplaydivs'>
                                <div id='nameOfMessageDiv'>
                                </div>
                                <div id='contentOfNews'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="../scripts/loginpage/material.min.js"></script>
        <script src="../scripts/loadInboxData.js"></script>
        <script src="../scripts/loadUserData.js"></script>
        <script src="../scripts/deleteMessages.js"></script>
        <script src="../scripts/inboxScripts.js"></script>
        <script src="../scripts/sendMsg.js"></script>
    </body>

    </html>
