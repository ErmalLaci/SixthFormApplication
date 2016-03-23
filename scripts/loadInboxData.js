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

                    var inboxdata = JSON.parse(res);
                    var amountofdata = inboxdata.length;
                    console.log("amount of data", amountofdata);

                    for (i = 0; i < amountofdata; i++) {
                        console.log(inboxdata[i].information);
                        console.log(inboxdata[i].nameofinformation);
                    }

                    var addedHTML = "<table border='0' class='mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp'><tr><td class='mdl-data-table__cell--non-numeric'>Messages: <span id='AmountOfNews'>" + amountofdata + "</span></td>";
                    //addedHTML += "<tr id='messagerow'><td class='mdl-data-table__cell--non-numeric' width='70%'><span id='idmessage'> gre </span></td>";
                    for (i = 0; i < amountofdata; i++) {
                        addedHTML += "<tr id='messagerow" + i + "'><td  style='cursor:hand' onclick='displayNewsFunction(\"" + inboxdata[i].nameofinformation + "\" ,\"" + inboxdata[i].information + "\");' class='mdl-data-table__cell--non-numeric' width='100%'><span width='100%' id='idmessage" + i + "'>" + inboxdata[i].nameofinformation + "</span></td>";
                        addedHTML += "<td><label class='mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect' for='checkbox" + i + "'><input type='checkbox' id='checkbox" + i + "' class='mdl-checkbox__input' ischecked='false'></label></td></tr>"
                    }
                    addedHTML += "</table>";
                    document.getElementById("News").innerHTML = addedHTML;
                    console.log("Retrieved XML successfully");

                } else {
                    console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/inboxservice.php";
        xmlhttp.open("GET", apiURL, true);
        console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData();
});