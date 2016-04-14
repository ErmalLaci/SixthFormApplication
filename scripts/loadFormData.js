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

                    var amountofdata = studentdata.length;
                    ////console.log("amount of data", amountofdata);
                    var nameofinfo = '';
                    var lengthofinfo = '';
                    var validationofinfo = '';
                    var displayinfo = '';
                    var typeofinfo = '';
                    var addedHTML = '';
                    var optionNumber = 0;
                    var currentType = '';
                    var currentValidation = '';

                    //Creates the inputs and remove option buttons
                    //It does this in a loop so it creates as many inputs as there are options
                    for (i = 0; i < amountofdata; i++) {
                        optionNumber += 1;
                        addedHTML += "<section>";
                        addedHTML += "<h2 class=''> Option " + optionNumber + "</h2> ";
                        nameofinfo = studentdata[i].name;
                        //console.log("nameofinfo: ", nameofinfo);
                        document.getElementById("displayformoptions").value = nameofinfo;
                        addedHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + nameofinfo + "' id='name" + i + "'><label class='mdl-textfield__label' for='name" + i + "'> Input Name </label></div>";

                        displayinfo = studentdata[i].display;
                        //console.log("displayinfo: ", displayinfo);
                        document.getElementById("displayformoptions").value = displayinfo;
                        addedHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' display='text' value='" + displayinfo + "' id='display" + i + "'><label class='mdl-textfield__label' for='display" + i + "'> Input Display </label></div>";


                        typeofinfo = studentdata[i].type;
                        //console.log("typeofinfo: ", typeofinfo);
                        document.getElementById("displayformoptions").value = typeofinfo;

                        currentType = "type" + i;

                        if (typeofinfo == 'VARCHAR') {
                            addedHTML += "<br><select id='" + currentType + "'><option value='VARCHAR' selected>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'INT') {
                            addedHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT' selected>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'YEAR') {
                            addedHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR' selected>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'TEXT') {
                            addedHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT' selected>Text</option><option value='ENUM'>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'ENUM') {
                            addedHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM' selected>Enum</option><option value='BIT'>Bit</option></select><br>";
                        } else if (typeofinfo == 'BIT') {
                            addedHTML += "<br><select id='" + currentType + "'><option value='VARCHAR'>Varchar</option><option value='INT'>Int</option><option value='YEAR'>Year</option><option value='TEXT'>Text</option><option value='ENUM'>Enum</option><option value='BIT' selected>Bit</option></select><br>";
                        }
                        addedHTML += "</script>";

                        lengthofinfo = studentdata[i].length;
                        //console.log("lengthofinfo: ", lengthofinfo);
                        document.getElementById("displayformoptions").value = lengthofinfo;
                        addedHTML += "<br><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' value='" + lengthofinfo + "' id='length" + i + "'><label class='mdl-textfield__label' for='length" + i + "'> Input Length </label></div>";

                        validationofinfo = studentdata[i].validate;
                        //console.log("lengthofinfo: ", lengthofinfo);
                        document.getElementById("displayformoptions").value = validationofinfo;

                        currentValidation = "validation" + i;

                        if (validationofinfo == "postcode") {
                            addedHTML += "<br><select  id='" + currentValidation + "'><option value='postcode' selected>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option></select><br>";
                        } else if (validationofinfo == "email") {
                            addedHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email' selected>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none'>None</option></select><br>";
                        } else if (validationofinfo == "numeric") {
                            addedHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric' selected>Numeric</option><option value='name'>Name</option><option value='none'>None</option></select><br>";
                        } else if (validationofinfo == "name") {
                            addedHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name' selected>Name</option><option value='none'>None</option></select><br>";
                        } else if (validationofinfo == "none") {
                            addedHTML += "<br><select  id='" + currentValidation + "'><option value='postcode'>Postcode</option><option value='email'>Email</option><option value='numeric'>Numeric</option><option value='name'>Name</option><option value='none' selected>None</option></select><br>";
                        }

                        addedHTML += "<br><button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' name='removeOption" + i + "' id='removeOption" + i + "' onclick='removeOptionFunction(\"" + nameofinfo + "\");'>Remove Option</button>";
                        addedHTML += "</section>";
                    }
                    document.getElementById("displayformoptions").innerHTML = addedHTML;
                    document.getElementById("numOfInputs").innerHTML = amountofdata;
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