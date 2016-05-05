var optionNames = [];
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
                    res = retreivedDoc; //get result data from php

                    var studentdata = JSON.parse(res);  //store json string as array
                    var amountOfOptions = studentdata.indexOf("End"); //get value for looping through options
                    var amountOfSubjects = studentdata.indexOf("End", amountOfOptions + 1); //get value for looping through subject
                    var amountOfData = studentdata.length;  //get length of array
                    var nameOfInfo = ''
                    var lengthOfInfo = '';
                    var validationOfInfo = '';
                    var displayInfo = '';
                    var typeOfInfo = '';
                    var addInputHTML = '';
                    var optionNumber = 0;
                    var currentType = '';
                    var currentValidation = '';

                    //Creates the inputs and remove option buttons
                    //It does this in a loop so it creates as many inputs as there are options
                    for (i = 0; i < amountOfOptions; i++) { //loop through options, display options in html
                        optionNumber += 1;
                        addInputHTML += "<div>";
                        addInputHTML += "<span style='font-size: 22px'> Option " + optionNumber + "</span> ";
                        nameOfInfo = studentdata[i].name;
                        optionNames[i] = nameOfInfo;  //stores original name of option in global array
                        document.getElementById("displayformoptions").value = nameOfInfo;
                        addInputHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + nameOfInfo + "' id='name" + i + "'><label class='mdl-textfield__label' for='name" + i + "'> Input Name </label></div>";

                        displayInfo = studentdata[i].display;
                        document.getElementById("displayformoptions").value = displayInfo;
                        addInputHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' display='text' value='" + displayInfo + "' id='display" + i + "'><label class='mdl-textfield__label' for='display" + i + "'> Input Display </label></div>";


                        typeOfInfo = studentdata[i].type;
                        document.getElementById("displayformoptions").value = typeOfInfo;

                        currentType = "type" + i;
                        //display dropdown for type of info
                        if (typeOfInfo == 'VARCHAR') {  //check type of input, if type is varchar create select varchar
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR' selected>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeOfInfo == 'INT') { //if type is int select int
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT' selected>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeOfInfo == 'YEAR') {  //if type is year select year
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR' selected>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeOfInfo == 'TEXT') {  //if type is text select text
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT' selected>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeOfInfo == 'ENUM') {  //if type is enum select enum
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM' selected>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeOfInfo == 'BIT') { //if type id bit select bit
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT' selected>Bit</option></select><br>";
                        }
                        addInputHTML += "</script>";

                        lengthOfInfo = studentdata[i].length;
                        //display length
                        document.getElementById("displayformoptions").value = lengthOfInfo;
                        addInputHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + lengthOfInfo + "' id='length" + i + "'><label class='mdl-textfield__label' for='length" + i + "'> Input Length </label></div>";

                        validationOfInfo = studentdata[i].validate;

                        document.getElementById("displayformoptions").value = validationOfInfo;

                        currentValidation = "validation" + i;
                        //check validation and display dropdown for validation, check for value of validation and select appropriate option in dropdown
                        if (validationOfInfo == "postcode") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode' selected>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationOfInfo == "email") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email' selected>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationOfInfo == "numeric") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric' selected>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationOfInfo == "name") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name' selected>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationOfInfo == "none") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none' selected>None</option><option value='phone'>Phone</option></select><br>";
                        }else if (validationOfInfo == "phone") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone' selected>Phone</option></select><br>";
                        }
                        //add button for removing option, onclick call remove option function and pass name of info
                        addInputHTML += "<br><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='removeOption" + i + "' id='removeOption" + i + "' onclick='removeOptionFunction(\"" + nameOfInfo + "\");'>Remove Option</button><br><br>";
                        addInputHTML += "<div id='error" + optionNumber + "'></div> </div>";
                    }
                    document.getElementById("displayformoptions").innerHTML = addInputHTML;
                    document.getElementById("numOfInputs").innerHTML = amountOfOptions;

                    var subjectName = "";
                    var subjectExamBoard = "";
                    var subjectId = "";
                    var subjectNumber = 0;
                    var addSubjectHTML = "<table border='0'>";

                    for (i = (amountOfOptions + 1); i < amountOfSubjects; i++) {  //loop through subject
                        subjectNumber += 1;
                        subjectId = studentdata[i].subject_id;
                        addSubjectHTML += "<tr>";
                        subjectName = studentdata[i].name;  //display row in table with subject information
                        addSubjectHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + subjectName + "' id='subjectName" + subjectNumber + "'><label class='mdl-textfield__label' for='subjectName" + subjectNumber + "'> Subject Name </label></td>";
                        subjectExamBoard = studentdata[i].exam_board;
                        if (subjectExamBoard == "AQA"){ //check value of exam board and select appropriate option in dropdown
                          addSubjectHTML += "<td><select name='chooseExamboard" + subjectNumber + "' id='chooseExamboard" + subjectNumber + "'><option value='AQA' selected>AQA</option><option value='OCR'>OCR</option><option value='EDEXCEL'>EDEXCEL</option></select></td>";
                        }else if(subjectExamBoard == "OCR"){
                          addSubjectHTML += "<td><select name='chooseExamboard" + subjectNumber + "' id='chooseExamboard" + subjectNumber + "'><option value='AQA'>AQA</option><option value='OCR' selected>OCR</option><option value='EDEXCEL'>EDEXCEL</option></select></td>";
                        }else if(subjectExamBoard == "EDEXCEL"){
                          addSubjectHTML += "<td><select name='chooseExamboard" + subjectNumber + "' id='chooseExamboard" + subjectNumber + "'><option value='AQA'>AQA</option><option value='OCR'>OCR</option><option value='EDEXCEL' selected>EDEXCEL</option></select></td>";
                        }
                        addSubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='removeSubject" + subjectNumber + "' id='removeSubject" + subjectNumber + "' onclick='removeSubjectFunction(" + subjectId + ");'>Remove Option</button></td>";
                        addSubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='updateSubject" + subjectNumber + "' id='updateSubject" + subjectNumber + "' onclick='updateSubjectFunction(" + subjectId + ", " + subjectNumber + ");'>Update Option</button></td>";
                        addSubjectHTML += "</tr>";
                    }
                    addSubjectHTML += "</table>";
                    document.getElementById("Subjects").innerHTML = addSubjectHTML;

                    var sixthFormSubjectName = "";
                    var sixthFormSubjectLevel = "";
                    var sixthFormSubjectBlock = "";
                    var sixthFormSubjectId = "";
                    var sixthFormSubjectNumber = 0;
                    var addSixthFormSubjectHTML = "<table border='0'>";

                    for (i = (amountOfSubjects + 1); i < (amountOfData - 1); i++) { //loop through sixth form subject
                        sixthFormSubjectNumber += 1;
                        sixthFormSubjectId = studentdata[i].sixthformsubject_id;
                        addSixthFormSubjectHTML += "<tr>";
                        sixthFormSubjectName = studentdata[i].name; //display subjects name
                        addSixthFormSubjectHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + sixthFormSubjectName + "' id='sixthFormSubjectName" + sixthFormSubjectNumber + "'><label class='mdl-textfield__label' for='sixthFormSubjectName" + sixthFormSubjectNumber + "'> sixthformsubject Name </label></td>";

                        sixthFormSubjectLevel = studentdata[i].level;
                        if (sixthFormSubjectLevel == "A Level"){  //check level of subject and select appropriate value in dropdown
                          addSixthFormSubjectHTML += "<td><select name='chooseLevel" + sixthFormSubjectNumber + "' id='chooseLevel" + sixthFormSubjectNumber + "'><option value='A Level' selected>A Level</option><option value='Level 2'>Level 2</option></td>";
                        }else if(sixthFormSubjectLevel == "Level 2"){
                          addSixthFormSubjectHTML += "<td><select name='chooseLevel" + sixthFormSubjectNumber + "' id='chooseLevel" + sixthFormSubjectNumber + "'><option value='A Level'>A Level</option><option value='Level 2' selected>Level 2</option></td>";
                        }
                        if (studentdata[i].block != null){  //check for blocks with inputs
                        sixthFormSubjectBlock = studentdata[i].block;
                        }
                        if (sixthFormSubjectBlock == "A"){  //check block of subject and select appropriate value in dropdown
                          addSixthFormSubjectHTML += "<td style='width:30px;'><select name='chooseBlock" + sixthFormSubjectNumber + "' id='chooseBlock" + sixthFormSubjectNumber + "'><option value='A' selected>A</option><option value='B'>B</option><option value='C'>C</option><option value='D'>D</option><option value='E'>E</option></td>";
                        }else if(sixthFormSubjectBlock == "B"){
                          addSixthFormSubjectHTML += "<td><select name='chooseBlock" + sixthFormSubjectNumber + "' id='chooseBlock" + sixthFormSubjectNumber + "'><option value='A'>A</option><option value='B' selected>B</option><option value='C'>C</option><option value='D'>D</option><option value='E'>E</option></td>";
                        }else if(sixthFormSubjectBlock == "C"){
                          addSixthFormSubjectHTML += "<td><select name='chooseBlock" + sixthFormSubjectNumber + "' id='chooseBlock" + sixthFormSubjectNumber + "'><option value='A'>A</option><option value='B'>B</option><option value='C' selected>C</option><option value='D'>D</option><option value='E'>E</option></td>";
                        }else if(sixthFormSubjectBlock == "D"){
                          addSixthFormSubjectHTML += "<td><select name='chooseBlock" + sixthFormSubjectNumber + "' id='chooseBlock" + sixthFormSubjectNumber + "'><option value='A'>A</option><option value='B' >B</option><option value='C' >C</option><option value='D' selected>D</option><option value='E'>E</option></td>";
                        }else if(sixthFormSubjectBlock == "E"){
                          addSixthFormSubjectHTML += "<td><select name='chooseBlock" + sixthFormSubjectNumber + "' id='chooseBlock" + sixthFormSubjectNumber + "'><option value='A'>A</option><option value='B' >B</option><option value='C' >C</option><option value='D' >D</option><option value='E' selected>E</option></td>";
                        } else {
                          addSixthFormSubjectHTML += "<td><select name='chooseBlock" + sixthFormSubjectNumber + "' id='chooseBlock" + sixthFormSubjectNumber + "'><option value='A'>A</option><option value='B' >B</option><option value='C' >C</option><option value='D' >D</option><option value='E'>E</option></td>";
                        }

                        addSixthFormSubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='removesixthformsubject" + sixthFormSubjectNumber + "' id='removesixthformsubject" + sixthFormSubjectNumber + "' onclick='removesixthformSubjectFunction(" + sixthFormSubjectId + ");'>Remove Subject</button></td>";
                        addSixthFormSubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='updatesixthformsubject" + sixthFormSubjectNumber + "' id='updatesixthformsubject" + sixthFormSubjectNumber + "' onclick='updatesixthformSubjectFunction(" + sixthFormSubjectId + ", " + sixthFormSubjectNumber + ");'>Update Subject</button></td>";
                        addSixthFormSubjectHTML += "</tr>";
                    }
                    addSixthFormSubjectHTML += "</table>";
                    document.getElementById("SixthFormSubjects").innerHTML = addSixthFormSubjectHTML; //display html
                    //console.log("Retrieved XML successfully");
                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/formService.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData(); //call loaddata() function
});
