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
                    res = retreivedDoc;
                    //var fixedResponse = res.replace(/\\'/g, "'");

                    var studentdata = JSON.parse(res);
                    var amountofoptions = studentdata.indexOf("End");
                    //console.log(amountofoptions);
                    var amountofsubjects = studentdata.indexOf("End", amountofoptions + 1);
                    var amountofdata = studentdata.length;
                    //console.log(amountofsubjects);
                    var nameofinfo = ''
                    var lengthofinfo = '';
                    var validationofinfo = '';
                    var displayinfo = '';
                    var typeofinfo = '';
                    var addInputHTML = '';
                    var optionNumber = 0;
                    var currentType = '';
                    var currentValidation = '';

                    //Creates the inputs and remove option buttons
                    //It does this in a loop so it creates as many inputs as there are options
                    for (i = 0; i < amountofoptions; i++) {

                        optionNumber += 1;
                        addInputHTML += "<div>";
                        addInputHTML += "<span style='font-size: 22px'> Option " + optionNumber + "</span> ";
                        nameofinfo = studentdata[i].name;
                        //console.log("nameofinfo: ", nameofinfo);
                        document.getElementById("displayformoptions").value = nameofinfo;
                        addInputHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + nameofinfo + "' id='name" + i + "'><label class='mdl-textfield__label' for='name" + i + "'> Input Name </label></div>";

                        displayinfo = studentdata[i].display;
                        //console.log("displayinfo: ", displayinfo);
                        document.getElementById("displayformoptions").value = displayinfo;
                        addInputHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' display='text' value='" + displayinfo + "' id='display" + i + "'><label class='mdl-textfield__label' for='display" + i + "'> Input Display </label></div>";


                        typeofinfo = studentdata[i].type;
                        //console.log("typeofinfo: ", typeofinfo);
                        document.getElementById("displayformoptions").value = typeofinfo;

                        currentType = "type" + i;

                        if (typeofinfo == 'VARCHAR') {
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR' selected>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'INT') {
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT' selected>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'YEAR') {
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR' selected>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'TEXT') {
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT' selected>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'ENUM') {
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM' selected>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'BIT') {
                            addInputHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT' selected>Bit</option></select><br>";
                        }
                        addInputHTML += "</script>";

                        lengthofinfo = studentdata[i].length;
                        //console.log("lengthofinfo: ", lengthofinfo);
                        document.getElementById("displayformoptions").value = lengthofinfo;
                        addInputHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + lengthofinfo + "' id='length" + i + "'><label class='mdl-textfield__label' for='length" + i + "'> Input Length </label></div>";

                        validationofinfo = studentdata[i].validate;
                        //console.log("lengthofinfo: ", lengthofinfo);
                        document.getElementById("displayformoptions").value = validationofinfo;

                        currentValidation = "validation" + i;

                        if (validationofinfo == "postcode") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode' selected>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationofinfo == "email") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email' selected>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationofinfo == "numeric") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric' selected>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationofinfo == "name") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name' selected>Name</option><option value='none'>None</option><option value='phone'>Phone</option></select><br>";
                        } else if (validationofinfo == "none") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none' selected>None</option><option value='phone'>Phone</option></select><br>";
                        }else if (validationofinfo == "phone") {
                            addInputHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option><option value='phone' selected>Phone</option></select><br>";
                        }

                        addInputHTML += "<br><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='removeOption" + i + "' id='removeOption" + i + "' onclick='removeOptionFunction(\"" + nameofinfo + "\");'>Remove Option</button><br><br>";
                        addInputHTML += "</div>";
                    }
                    document.getElementById("displayformoptions").innerHTML = addInputHTML;
                    document.getElementById("numOfInputs").innerHTML = amountofoptions;

                    var subjectname = "";
                    var subjectexamboard = "";
                    var subjectid = "";
                    var subjectNumber = 0;
                    var addSubjectHTML = "<table border='0'>";

                    for (i = (amountofoptions + 1); i < amountofsubjects; i++) {
                        subjectNumber += 1;
                        subjectid = studentdata[i].subject_id;
                        addSubjectHTML += "<tr>";
                        subjectname = studentdata[i].name;
                        addSubjectHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + subjectname + "' id='subjectname" + subjectNumber + "'><label class='mdl-textfield__label' for='subjectname" + subjectNumber + "'> Subject Name </label></td>";

                        subjectexamboard = studentdata[i].exam_board;
                        if (subjectexamboard == "AQA"){
                          addSubjectHTML += "<td><select name='chooseExamboard" + subjectNumber + "' id='chooseExamboard" + subjectNumber + "'><option value='AQA' selected>AQA</option><option value='OCR'>OCR</option><option value='EDEXCEL'>EDEXCEL</option></select></td>";
                        }else if(subjectexamboard == "OCR"){
                          addSubjectHTML += "<td><select name='chooseExamboard" + subjectNumber + "' id='chooseExamboard" + subjectNumber + "'><option value='AQA'>AQA</option><option value='OCR' selected>OCR</option><option value='EDEXCEL'>EDEXCEL</option></select></td>";
                        }else if(subjectexamboard == "EDEXCEL"){
                          addSubjectHTML += "<td><select name='chooseExamboard" + subjectNumber + "' id='chooseExamboard" + subjectNumber + "'><option value='AQA'>AQA</option><option value='OCR'>OCR</option><option value='EDEXCEL' selected>EDEXCEL</option></select></td>";
                        }
                        addSubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='removeSubject" + subjectNumber + "' id='removeSubject" + subjectNumber + "' onclick='removeSubjectFunction(" + subjectid + ");'>Remove Option</button></td>";
                        addSubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='updateSubject" + subjectNumber + "' id='updateSubject" + subjectNumber + "' onclick='updateSubjectFunction(" + subjectid + ", " + subjectNumber + ");'>Update Option</button></td>";
                        addSubjectHTML += "</tr>";
                    }
                    addSubjectHTML += "</table>";
                    document.getElementById("Subjects").innerHTML = addSubjectHTML;

                    var sixthformsubjectname = "";
                    var sixthformsubjectlevel = "";
                    var sixthformsubjectblock = "";
                    var sixthformsubjectid = "";
                    var sixthformsubjectNumber = 0;
                    var addsixthformsubjectHTML = "<table border='0'>";

                    for (i = (amountofsubjects + 1); i < (amountofdata - 1); i++) {
                        sixthformsubjectNumber += 1;
                        sixthformsubjectid = studentdata[i].sixthformsubject_id;
                        addsixthformsubjectHTML += "<tr>";
                        sixthformsubjectname = studentdata[i].name;
                        addsixthformsubjectHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + sixthformsubjectname + "' id='sixthformsubjectname" + sixthformsubjectNumber + "'><label class='mdl-textfield__label' for='sixthformsubjectname" + sixthformsubjectNumber + "'> sixthformsubject Name </label></td>";

                        sixthformsubjectlevel = studentdata[i].level;
                        if (sixthformsubjectlevel == "A Level"){
                          addsixthformsubjectHTML += "<td><select name='chooseLevel" + sixthformsubjectNumber + "' id='chooseLevel" + sixthformsubjectNumber + "'><option value='A Level' selected>A Level</option><option value='Level 2'>Level 2</option></td>";
                        }else if(sixthformsubjectlevel == "Level 2"){
                          addsixthformsubjectHTML += "<td><select name='chooseLevel" + sixthformsubjectNumber + "' id='chooseLevel" + sixthformsubjectNumber + "'><option value='A Level'>A Level</option><option value='Level 2' selected>Level 2</option></td>";
                        }
                        if (studentdata[i].block != null){
                        sixthformsubjectblock = studentdata[i].block;
                        }
                        if (sixthformsubjectblock == "A"){
                          addsixthformsubjectHTML += "<td style='width:30px;'><select name='chooseBlock" + sixthformsubjectNumber + "' id='chooseBlock" + sixthformsubjectNumber + "'><option value='A' selected>A</option><option value='B'>B</option><option value='C'>C</option><option value='D'>D</option><option value='E'>E</option></td>";
                        }else if(sixthformsubjectblock == "B"){
                          addsixthformsubjectHTML += "<td><select name='chooseBlock" + sixthformsubjectNumber + "' id='chooseBlock" + sixthformsubjectNumber + "'><option value='A'>A</option><option value='B' selected>B</option><option value='C'>C</option><option value='D'>D</option><option value='E'>E</option></td>";
                        }else if(sixthformsubjectblock == "C"){
                          addsixthformsubjectHTML += "<td><select name='chooseBlock" + sixthformsubjectNumber + "' id='chooseBlock" + sixthformsubjectNumber + "'><option value='A'>A</option><option value='B'>B</option><option value='C' selected>C</option><option value='D'>D</option><option value='E'>E</option></td>";
                        }else if(sixthformsubjectblock == "D"){
                          addsixthformsubjectHTML += "<td><select name='chooseBlock" + sixthformsubjectNumber + "' id='chooseBlock" + sixthformsubjectNumber + "'><option value='A'>A</option><option value='B' >B</option><option value='C' >C</option><option value='D' selected>D</option><option value='E'>E</option></td>";
                        }else if(sixthformsubjectblock == "E"){
                          addsixthformsubjectHTML += "<td><select name='chooseBlock" + sixthformsubjectNumber + "' id='chooseBlock" + sixthformsubjectNumber + "'><option value='A'>A</option><option value='B' >B</option><option value='C' >C</option><option value='D' >D</option><option value='E' selected>E</option></td>";
                        } else {
                          addsixthformsubjectHTML += "<td><select name='chooseBlock" + sixthformsubjectNumber + "' id='chooseBlock" + sixthformsubjectNumber + "'><option value='A'>A</option><option value='B' >B</option><option value='C' >C</option><option value='D' >D</option><option value='E'>E</option></td>";
                        }

                        addsixthformsubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='removesixthformsubject" + sixthformsubjectNumber + "' id='removesixthformsubject" + sixthformsubjectNumber + "' onclick='removesixthformSubjectFunction(" + sixthformsubjectid + ");'>Remove Subject</button></td>";
                        addsixthformsubjectHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='updatesixthformsubject" + sixthformsubjectNumber + "' id='updatesixthformsubject" + sixthformsubjectNumber + "' onclick='updatesixthformSubjectFunction(" + sixthformsubjectid + ", " + sixthformsubjectNumber + ");'>Update Subject</button></td>";
                        addsixthformsubjectHTML += "</tr>";
                    }
                    addsixthformsubjectHTML += "</table>";
                    document.getElementById("SixthFormSubjects").innerHTML = addsixthformsubjectHTML;
                    //console.log("Retrieved XML successfully");
                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/formservice.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData();
});
