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

                    var data = JSON.parse(res); //store json string in array
                    var amountOfInfo = data.indexOf("End"); //get value for looping info
                    var amountOfGrades = data.indexOf("End", amountOfInfo + 3); //get value for looping grades
                    var amountOfCourses = data.indexOf("End", amountOfGrades + 1);  //get value for looping courses
                    var applicantDataIndex = amountOfInfo + 1;  //get value for index storing applicant info
                    var acceptedHTML = "";
                    //var amountofdata = data.length;
                    var addedHTML = "<div class='mdl-grid funky-table'><div class='mdl-cell mdl-cell--8-col' style='margin-top: 0px; margin-bottom: 0px;'><h4>Your Info</h4></div>";
                    var currentName = "";

                    for (i = 0; i < amountOfInfo; i++){ //loop through all info, display applicants information
                      currentName = data[i].name;
                      addedHTML += "<div class='mdl-cell mdl-cell--8-col' style='margin-top: 0px'>" + data[i].display + " " + data[applicantDataIndex][currentName] + "</div>";
                    }
                    if (data[applicantDataIndex].accepted == 0){
                      acceptedHTML = "You have yet to be accepted to Highdown Sixth Form.";
                    } else {
                      accepted = "You have been accepted. Congratulations!";
                    }
                    document.getElementById("displayAccepted").innerHTML = acceptedHTML;
                    addedHTML += "</div>";
                    for (i = (amountOfInfo + 3); i < amountOfGrades; i++) { //loop through all grades, display all grades
                      if (i < (amountOfInfo + 4)){  //check if its the first row
                        name = data[i].fname + " " + data[i].sname; //create table to store grades
                        addedHTML += "<div class='funky-table'><div class='mdl-grid'><div class='mdl-cell mdl-cell--12-col'><table class='displayStudentsTable'>";
                        addedHTML += "<thead><tr><th>Subject</th><th>Exam Board</th><th>Predicted Grade</th><th>Mock Result</th><th>Actual Result</th><th>Year Taken</th></tr></thead>";
                        addedHTML += "<tbody><tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" + data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                      }else{  //add rows with grades
                          addedHTML += "<tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" +  data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                      }
                    }

                    addedHTML += "</tbody></table></div></div></div>";
                    addedHTML += "<div class='mdl-grid funky-table'>";
                    for (i = (amountOfGrades + 1); i < amountOfCourses; i++){ //loop through all courses, display course information
                      addedHTML += "<div class='mdl-cell mdl-cell--4-col'>Subject: " + data[i].name + " <br> Level: " + data[i].level + "</div>";
                    }
                    addedHTML += "</div>";
                    document.getElementById("displayMyInfo").innerHTML = addedHTML; //display html in div

                    //console.log("Retrieved XML successfully");
                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/applicantService.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData();
});
