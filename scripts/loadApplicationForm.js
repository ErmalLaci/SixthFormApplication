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

                    var addedHTML = "";   //Create a variable to hold the HTML to add to the form
                    for (i = 0; i < amountofdata; i++) {    //Loop for every row selected
                      console.log(inputData[i].type)
                      if (inputData[i].type == "VARCHAR"){    //Check the type of data, depending on the type of data there will be a different display
                        addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--8-col'><div class='mdl-textfield mdl-js-textfield applicationInputs'><input class='mdl-textfield__input' type='text' name='input" + i + "' id='input" + i + "'><label class='mdl-textfield__label' for=''input" + i + "'>" + inputData[i].display + "</label></div></div></div>";
                      } else if(inputData[i].type == "ENUM"){
                        var options = inputData[i].length.split(",");
                        addedHTML += "<div class='mdl-grid'><div class='mdl-cell mdl-cell--2-col'>" + inputData[i].display +"</div><div class='mdl-cell mdl-cell--4-col'><select name='input" + i + "'>";
                          for (x = 0; x < options.length; x++){
                          addedHTML += ":<option value='" + options[x] + "'>" + options[x].toUpperCase() + "</option>";
                          }
                        addedHTML += "</select></div></div>";
                      }
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
