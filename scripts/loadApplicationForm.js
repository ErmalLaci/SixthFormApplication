$(document).ready(function () {
    function loadData() {
        //console.log("Retrieving Form Data..");

        var xmlhttp;

        if (window.XMLHttpRequest) {
            //Code for modern browsers
            xmlhttp = new XMLHttpRequest();
        } else {
            //Code for old IE browsers
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //Handle the xml response
                retreivedDoc = xmlhttp.responseText;
                if (retreivedDoc) {
                    //Response
                    var res = '';
                    res = retreivedDoc; //get result from php

                    var inputData = JSON.parse(res);  //turn json string into array
                    var amountOfData = inputData.length;
                    var options = "";
                    var addedHTML = ""; //Create a variable to hold the HTML to add to the form
                    for (i = 0; i < amountOfData; i++) { //Loop for every row selected
                        if (inputData[i].type == "VARCHAR") { //Check the type of data, depending on the type of data there will be a different display
                            //If type is varchar then create a textfield
                            if (inputData[i].validate == "numeric"){
                              addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--8-col'><div class='mdl-textfield mdl-js-textfield applicationInputs'><input class='mdl-textfield__input input-varchar " + inputData[i].validate + "' type='text' pattern='[0-9]*(\.[0-9]+)?' name='input" + i + "' id='input" + i + "' maxlength='" + inputData[i].length + "' minlength='" + inputData[i].length + "'><label class='mdl-textfield__label' for=''input" + i + "'>" + inputData[i].display + "</label><span class='mdl-textfield__error'>Input is not a valid number!</span></div></div></div>";
                            } else {
                              addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--8-col'><div class='mdl-textfield mdl-js-textfield applicationInputs'><input class='mdl-textfield__input input-varchar " + inputData[i].validate + "' type='text' name='input" + i + "' id='input" + i + "' maxlength='" + inputData[i].length + "'><label class='mdl-textfield__label' for=''input" + i + "'>" + inputData[i].display + "</label></div></div></div>";
                            }
                            //The max length is limited to the length of the VARCHAR field
                            //The display is shown in the label
                        } else if (inputData[i].type == "ENUM") {
                            //Split the options variable at the comma to get each option in the table
                            options = inputData[i].length.split(",");
                            //If the type is enum then create a dropdown mdl-textfield__input
                            addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--2-col'>" + inputData[i].display + "</div><div class='mdl-cell mdl-cell--4-col'><select class='input-enum' name='input" + i + "'>";
                            for (x = 0; x < options.length; x++) { //loops for each option
                                addedHTML += ":<option value='" + options[x] + "'>" + options[x].toUpperCase() + "</option>"; //creates an option in the dropdown for each valid answer
                            }
                            addedHTML += "</select></div></div>";
                        } else if (inputData[i].type == "BIT") {
                            //If the type is bit then it creates radio buttons as I use bits where 1 is true and 0 is false
                            addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--12-col'>" + inputData[i].display + "</div></div><div class='mdl-grid'><div class='mdl-cell mdl-cell--4-col'><label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='radioButton" + i + "-option-1'><input type='radio' id='radioButton" + i + "-option-1' class='mdl-radio__button' name='input" + i + "' value='1' checked><span class='mdl-radio__label'>Yes</span></label></div><div class='mdl-cell mdl-cell--4-col'><label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='radioButton" + i + "-option-2'><input type='radio' id='radioButton" + i + "-option-2' class='mdl-radio__button' name='options-learningneeds' value='0'><span class='mdl-radio__label'>No</span></label></div></div>";
                        } else if (inputData[i].type == "YEAR") {
                            //If the type is year then create a dropdown
                            //Split at the - as the length will hold the minimum and maximum years
                            options = inputData[i].length.split("-");
                            //Make sure minYear and maxYear are integers as I use a comparison operator later
                            var minYear = parseInt(options[0]);
                            var maxYear = parseInt(options[1]);
                            var currentYear = minYear;
                            addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'>" + inputData[i].display + "</div><div class='mdl-cell mdl-cell--4-col'><select class='input-enum' name='input" + i + "'>";
                            while (maxYear >= currentYear) { //Loop for each of the years available
                                addedHTML += ":<option value='" + currentYear + "'>" + currentYear + "</option>";
                                currentYear += 1;
                            }
                            addedHTML += "</select></div></div>";
                        }
                    }
                    document.getElementById("applicantDetails").innerHTML = addedHTML;
                    //console.log("Retrieved XML successfully");

                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/service.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }

    loadData();

    function loadCourses() {
        //console.log("Retrieving Form Data..");

        var xmlhttp;

        if (window.XMLHttpRequest) {
            //Code for modern browsers
            xmlhttp = new XMLHttpRequest();
        } else {
            //Code for old IE browsers
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //Handle the xml response
                retreivedDoc = xmlhttp.responseText;
                if (retreivedDoc) {
                    //Response
                    var res = '';
                    res = retreivedDoc;
                    //var fixedResponse = res.replace(/\\'/g, "'");

                    var inputData = JSON.parse(res);
                    var amountOfData = inputData.length;

                    var blockAHTML = "";
                    var blockBHTML = "";
                    var blockCHTML = "";
                    var blockDHTML = "";
                    var blockEHTML = "";
                    var level2HTML = "";


                    for (i = 0; i < amountOfData; i++) { //Loop for every row selected

                        if (inputData[i].level == "A Level") {
                            if (inputData[i].block == "A") {
                                blockAHTML += "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' name='blockA-options' value='" + inputData[i].name + "'>" + inputData[i].name + "</td></tr>";
                            } else if (inputData[i].block == "B") {
                                blockBHTML += "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' name='blockB-options' value='" + inputData[i].name + "'>" + inputData[i].name + "</td></tr>";
                            } else if (inputData[i].block == "C") {
                                blockCHTML += "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' name='blockC-options' value='" + inputData[i].name + "'>" + inputData[i].name + "</td></tr>";
                            } else if (inputData[i].block == "D") {
                                blockDHTML += "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' name='blockD-options' value='" + inputData[i].name + "'>" + inputData[i].name + "</td></tr>";
                            } else if (inputData[i].block == "E") {
                                blockEHTML += "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' name='blockE-options' value='" + inputData[i].name + "'>" + inputData[i].name + "</td></tr>";
                            }
                        } else if (inputData[i].level == "Level 2") {
                            level2HTML += "<tr><td class='mdl-data-table__cell--non-numeric'><input type='radio' name='level2-options' value='" + inputData[i].name + "'>" + inputData[i].name + "</td></tr>";
                        }
                    }
                    document.getElementById("blockA-table").innerHTML = blockAHTML;
                    document.getElementById("blockB-table").innerHTML = blockBHTML;
                    document.getElementById("blockC-table").innerHTML = blockCHTML;
                    document.getElementById("blockD-table").innerHTML = blockDHTML;
                    document.getElementById("blockE-table").innerHTML = blockEHTML;
                    document.getElementById("level2-table").innerHTML = level2HTML;

                    //console.log("Retrieved XML successfully");

                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/selectCoursesService.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }

    loadCourses();

});
