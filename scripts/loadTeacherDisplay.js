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
                    //console.log(data);
                    var amountofdata = data.length;
                    var addedHTML = "";
                    var collapseNumber = 0;
                    for (i = 0; i < amountofdata; i++) {
                      if (i < 1){
                        name = data[i].fname + " " + data[i].sname;
                        addedHTML += "<div class='funky-table'><div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'><button type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab collapsebutton' onclick='switchDisplay(" + collapseNumber + ");'><i class='material-icons' id='collapsebutton" + collapseNumber + "'>add</i></button>" + name + "</div></div>  <div class='mdl-grid'><div class='mdl-cell mdl-cell--10-col collapse'><table class='displayStudentsTable'>";
                        addedHTML += "<thead><tr><th>Subject</th><th>Exam Board</th><th>Predicted Grade</th><th>Mock Result</th><th>Actual Result</th><th>Year Taken</th></tr></thead>";
                        addedHTML += "<tbody><tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" + data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                        collapseNumber += 1;
                      } else {
                        if(data[i].applicant_id != data[i-1].applicant_id){
                          name = data[i].fname + " " + data[i].sname;
                          addedHTML += "</tbody></table></div></div></div>";
                          addedHTML += "<div class='funky-table'><div class='mdl-grid'><div class='mdl-cell mdl-cell--6-col'><button type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab collapsebutton' onclick='switchDisplay(" + collapseNumber + ");'><i class='material-icons' id='collapsebutton" + collapseNumber + "'>add</i></button>" + name + "</div></div>  <div class='mdl-grid'><div class='mdl-cell mdl-cell--10-col collapse'><table class='displayStudentsTable'>";
                          //console.log(i);
                          addedHTML += "<thead><tr><th>Subject</th><th>Exam Board</th><th>Predicted Grade</th><th>Mock Result</th><th>Actual Result</th><th>Year Taken</th></tr></thead>";
                          addedHTML += "<tbody><tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" + data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                          collapseNumber += 1;
                        }else{
                          addedHTML += "<tr><td>" + data[i].name + "</td><td>" + data[i].exam_board + "</td><td>" + data[i].predicted_grade + "</td><td>" +  data[i].mock_result + "</td><td>" + data[i].actual_result + "</td><td>" + data[i].year_taken + "</td></tr>";
                        }
                      }
                    }
                    addedHTML += "</tbody></table></div></div></div>";

                    document.getElementById("students").innerHTML = addedHTML;
                    hide();
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
