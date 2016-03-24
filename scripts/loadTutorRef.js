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

                    var GCSEdata = JSON.parse(res);

                    console.log(GCSEdata[0].name);

                    for (i = 0; i < GCSEdata.length; i++){
                      document.getElementById("displayStudentsGrades").innerHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--8-col'>Subject: " + GCSEdata[i].name + " | Exam board: " + GCSEdata[i].exam_board + " | Predicted Grade: " + GCSEdata[i].predicted_grade + " | Mock result: " + GCSEdata[i].mock_result + " | Actual result: " + GCSEdata[i].actual_result + " | Year exam was taken: " + GCSEdata[i].year_taken +  "</div>";
                    }
                    //console.log(studentdata[0]);

                    //console.log("Retrieved XML successfully");
                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/tutorRefService.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData();
});
