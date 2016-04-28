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

                    var data = JSON.parse(res);
                    console.log(data);
                    var amountofinfo = data.indexOf("End");
                    var amountofgrades = data.indexOf("End", amountofinfo + 3);
                    var amountofcourses = data.indexOf("End", amountofgrades + 1);
                    var applicantDataIndex = amountofinfo + 1;
                    //var amountofdata = data.length;
                    var addedHTML = "<div class='mdl-grid funky-table'><div class='mdl-cell mdl-cell--8-col' style='margin-top: 0px; margin-bottom: 0px;'><h4>Your Info</h4></div>";
                    var currentName = "";

                    for (i = 0; i < amountofinfo; i++){
                      currentName = data[i].name;
                      addedHTML += "<div class='mdl-cell mdl-cell--8-col' style='margin-top: 0px'>" + data[i].display + " " + data[applicantDataIndex][currentName] + "</div>";
                    }

                    addedHTML += "</div>";
                    for (i = (amountofinfo + 3); i < amountofgrades; i++) {
                      if (i < (amountofinfo + 4)){
                        name = data[i].fname + " " + data[i].sname;
                        addedHTML += "<div class='funky-table'><div class='mdl-grid'><div class='mdl-cell mdl-cell--12-col'><table class='displayStudentsTable'>";
                        addedHTML += "<thead><tr><th>Subject</th><th>Exam Board</th><th>Predicted Grade</th><th>Mock Result</th><th>Actual Result</th><th>Year Taken</th></tr></thead>";
                        addedHTML += "<tbody><tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" + data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                      }else{
                          addedHTML += "<tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" +  data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                      }
                    }

                    addedHTML += "</tbody></table></div></div></div>";
                    addedHTML += "<div class='mdl-grid funky-table'>";
                    for (i = (amountofgrades + 1); i < amountofcourses; i++){
                      addedHTML += "<div class='mdl-cell mdl-cell--4-col'>Subject: " + data[i].name + " <br> Level: " + data[i].level + "</div>";
                    }
                    addedHTML += "</div>";
                    document.getElementById("displayMyInfo").innerHTML = addedHTML;

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
