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

                    var userData = JSON.parse(res);  //turn json string into array

                    var username = userData[0].username; //get username and type of user
                    var type = userData[0].type;

                    document.getElementById("display-usertype").innerHTML = type.toUpperCase(); //display username and type
                    document.getElementById("displayusername").innerHTML = username;

                    //console.log("Retrieved XML successfully");
                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/userService.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }
    loadData();
});
