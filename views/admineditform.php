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
        <title>AdminEditForm</title>
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
                    <span class="mdl-layout-title">Edit Form</span>
                    <div class="mdl-layout-spacer"></div>
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
                    <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">edit</i>Edit Form</a>
                    <a class="mdl-navigation__link" href="../db/logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Logout</a>
                </nav>
            </div>
            <main class="mdl-layout__content mdl-color--grey-100">
                <div class="mdl-grid">
                    <!-- Student Info -->
                    <div class="mdl-cell mdl-cell--1-col" id="numOfInputs" style="display: none;">
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                        <div id="displayformoptions"></div>
                        <!-- ajax fills in -->
                        <div class="mdl-cell mdl-cell--4-col">
                            <center>
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" id="updateFormButton">
                                    Submit
                                </button>
                            </center>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                        <form id="displayaddformoptions" method="post" action="../db/updateform/addoption.php" onsubmit="return ValidateInput(this)">
                            <!-- Add an option  -->
                            <h2>Add Input</h2>
                            <br>
                            <table border="0">
                                <tr>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" id="addInputName" name="addOptionName">
                                        <label class="mdl-textfield__label" for="addInputName">Input Name</label>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" id="addInputDisplay" name="addOptionDisplay">
                                        <label class="mdl-textfield__label" for="addInputName">Input Display</label>
                                    </div>
                                </tr>
                                <tr>
                                    Input Type:
                                    <select name="addOptionType" id="addInputType">
                                        <option value="VARCHAR">Varchar</option>
                                        <option value="INT">Int</option>
                                        <option value="YEAR">Year</option>
                                        <option value="TEXT">Text</option>
                                        <option value="ENUM">Enum</option>
                                        <option value="BIT">Bit</option>
                                    </select>
                                </tr>
                                <tr>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="text" id="addInputLength" name="addOptionLength">
                                        <label class="mdl-textfield__label" for="addInputLength">Input Length</label>
                                    </div>
                                </tr>
                                <tr>
                                    Input Type:
                                    <select name="addOptionValidate" id="addInputValidate">
                                        <option value="postcode">Postcode</option>
                                        <option value="email">Email</option>
                                        <option value="numeric">Numeric</option>
                                        <option value="name">Name</option>
                                        <option value="none" selected>None</option>
                                    </select>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" id="addFormOptionButton">
                                            Add Input
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="errorDisplay" style="color:red;">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                        <div>
                            <h2>Instructions</h2></div>
                        <br>
                        <div class="instructions">
                            v
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="../scripts/AddInputValidation.js"></script>
        <script src="../scripts/loadFormData.js"></script>
        <script src="../scripts/loadUserData.js"></script>
        <script src="../scripts/updateForm.js"></script>
        <script src="../scripts/removeOption.js"></script>
        <script src="../scripts/loginpage/material.min.js"></script>
    </body>

    </html>