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
                    /*var amountofoptions = studentdata.indexOf("End");
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

                    }
                    document.getElementById("displayformoptions").innerHTML = addInputHTML;

                    for (i = (amountofoptions + 1); i < amountofsubjects; i++) {

                    }
                    document.getElementById("Subjects").innerHTML = addSubjectHTML;

                    for (i = (amountofsubjects + 1); i < (amountofdata - 1); i++) {

                    }
                    addsixthformsubjectHTML += "</table>";
                    document.getElementById("SixthFormSubjects").innerHTML = addsixthformsubjectHTML;
                    */
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
