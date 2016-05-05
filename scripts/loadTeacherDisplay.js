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

                    var data = JSON.parse(res); //turn json string into array

                    var amountOfData = data.length; //get size of array
                    var addedHTML = "";
                    var name = "";
                    var collapseNumber = 0; //store number of collapse buttons
                    for (i = 0; i < amountOfData; i++) {  //loop through all students and their grades
                      if (i < 1){ //check if it is the first input, if it is create the table
                        name = data[i].fname + " " + data[i].sname;
                        addedHTML += "<div class='funky-table'><div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'><button type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab collapsebutton' onclick='switchDisplay(" + collapseNumber + ");'><i class='material-icons' id='collapsebutton" + collapseNumber + "'>add</i></button>" + name + "</div></div>  <div class='mdl-grid'><div class='mdl-cell mdl-cell--10-col collapse'><table class='displayStudentsTable'>";
                        addedHTML += "<thead><tr><th>Subject</th><th>Exam Board</th><th>Predicted Grade</th><th>Mock Result</th><th>Actual Result</th><th>Year Taken</th></tr></thead>";
                        addedHTML += "<tbody><tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" + data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                        collapseNumber += 1;
                      } else {
                        if(data[i].applicant_id != data[i-1].applicant_id){ //check if it is the same applicants grades or a new applicant
                          name = data[i].fname + " " + data[i].sname; //if not create a new display
                          addedHTML += "</tbody></table></div></div></div>";
                          addedHTML += "<div class='funky-table'><div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'><button type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab collapsebutton' onclick='switchDisplay(" + collapseNumber + ");'><i class='material-icons' id='collapsebutton" + collapseNumber + "'>add</i></button>" + name + "</div></div>  <div class='mdl-grid'><div class='mdl-cell mdl-cell--10-col collapse'><table class='displayStudentsTable'>";
                          addedHTML += "<thead><tr><th>Subject</th><th>Exam Board</th><th>Predicted Grade</th><th>Mock Result</th><th>Actual Result</th><th>Year Taken</th></tr></thead>";
                          addedHTML += "<tbody><tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" + data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                          collapseNumber += 1;
                        }else{  //if it is the same applicant add a new row
                          addedHTML += "<tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" +  data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                        }
                      }
                    }
                    addedHTML += "</tbody></table></div></div></div>";

                    document.getElementById("students").innerHTML = addedHTML;
                    hide(); //hide all applicant information except their name, teachers can view their information by click the collapse button
                    //console.log("Retrieved XML successfully");
                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/teacherService.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData();
});
