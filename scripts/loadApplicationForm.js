$(document).ready(function () {
    function loadData() {
        console.log("Retrieving Form Data..");

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
                    var amountofdata = inputData.length;
                    //console.log("amount of data", amountofdata);

                    var addedHTML = "";
                    for (i = 0; i < amountofdata; i++) {
                        addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell-8-col'><div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input' type='text' name='input" + inputData[i].name + "' id='input" + i + "'><label class='mdl-textfield__label' for=''input" + i + "'>" + inputData[i].display + "</label></div></div></div>";
                    }
                    document.getElementById("applicantDetails").innerHTML = addedHTML;
                    console.log("Retrieved XML successfully");

                } else {
                    console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/service.php";
        xmlhttp.open("GET", apiURL, true);
        console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData();
});
