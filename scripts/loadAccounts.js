var departments = [];
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

                    var inputData = JSON.parse(res);
                    inputData[0].Type = inputData[0].Type.replace("enum","");
                    inputData[0].Type = inputData[0].Type.replace("(", "");
                    inputData[0].Type = inputData[0].Type.replace(")", "");
                    inputData[0].Type = inputData[0].Type.split("'").join("");
                    departments = inputData[0].Type.split(",");

                    var amountofteachers = inputData.indexOf("End", 3);
                    var amountofsubjects = inputData.indexOf("End", amountofteachers + 1);

                    var amountofdata = inputData.length;
                    var options = "";
                    var departmentOptionsHTML = ""; //Create a variable to hold the HTML to add to the form

                    for (i = 0; i < departments.length; i++){
                      departmentOptionsHTML += "<option value='" + departments[i] + "'>" + departments[i] + "</option>";
                    }
                    document.getElementById("createTeacherDepartment").innerHTML = departmentOptionsHTML;


                    var displayTeachersHTML = "";
                    var currentTeacher = "";
                    for(i = 2; i < amountofteachers; i++){
                      currentTeacher = inputData[i];
                      displayTeachersHTML += "<table class='funky-table'>";
                      displayTeachersHTML += "<tr>";
                      displayTeachersHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'><input class='mdl-textfield__input' type='text' value='" + currentTeacher.username + "' id='teacherusername" + currentTeacher.login_id + "'><label class='mdl-textfield__label' for='teacherusername" + currentTeacher.login_id + "'>Username</label></td>";
                      displayTeachersHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'><input class='mdl-textfield__input' type='text' value='" + currentTeacher.password + "' id='teacherpassword" + currentTeacher.login_id + "'><label class='mdl-textfield__label' for='teacherpassword" + currentTeacher.login_id + "'>Password</label></td>";
                      displayTeachersHTML += "</tr>";
                      displayTeachersHTML += "<tr>";
                      displayTeachersHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'><input class='mdl-textfield__input' type='text' value='" + currentTeacher.fname + "' id='teacherfname" + currentTeacher.login_id + "'><label class='mdl-textfield__label' for='teacherfname" + currentTeacher.login_id + "'>First Name</label></td>";
                      displayTeachersHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'><input class='mdl-textfield__input' type='text' value='" + currentTeacher.sname + "' id='teachersname" + currentTeacher.login_id + "'><label class='mdl-textfield__label' for='teachersname" + currentTeacher.login_id + "'>Surname</label></td>";
                      displayTeachersHTML += "</tr>";
                      displayTeachersHTML += "<tr>";
                      displayTeachersHTML += "<td><select id='teacherdepartment" + currentTeacher.login_id + "'>";
                      for (x = 0; x < departments.length; x++){
                        if (currentTeacher.department == departments[x]){
                          displayTeachersHTML += "<option value='" + departments[x] + "' selected>" + departments[x] + "</option>";
                        } else {
                          displayTeachersHTML += "<option value='" + departments[x] + "'>" + departments[x] + "</option>";
                        }
                      }
                      displayTeachersHTML +="</select></td>";
                      displayTeachersHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised' onclick='deleteAccount(" + currentTeacher.login_id + ");'>Delete</button></td>";
                      displayTeachersHTML += "<tr><td><button class='mdl-button mdl-js-button mdl-button--raised' onclick='updateTeacherAccount(" + currentTeacher.login_id + ", \"" + currentTeacher.username + "\");'>Update</button></td></tr>";
                      displayTeachersHTML += "</table>";

                    }
                    document.getElementById("showTeachers").innerHTML = displayTeachersHTML;

                    var displayAdminHTML = "";
                    for(i = (amountofteachers + 1); i < amountofsubjects; i++){
                      currentAdmin = inputData[i];
                      displayAdminHTML += "<table class='funky-table'>";
                      displayAdminHTML += "<tr>";
                      displayAdminHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'><input class='mdl-textfield__input' type='text' value='" + currentAdmin.username + "' id='adminusername" + currentAdmin.login_id + "'><label class='mdl-textfield__label' for='adminusername" + currentAdmin.login_id + "'>Username</label></td>";
                      displayAdminHTML += "<td><div style='width:100%' class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'><input class='mdl-textfield__input' type='text' value='" + currentAdmin.password + "' id='adminpassword" + currentAdmin.login_id + "'><label class='mdl-textfield__label' for='adminpassword" + currentAdmin.login_id + "'>Password</label></td>";
                      displayAdminHTML += "</tr>";
                      displayAdminHTML += "<tr><td><button class='mdl-button mdl-js-button mdl-button--raised' onclick='deleteAccount(" + currentAdmin.login_id + ");'>Delete</button></td>";
                      displayAdminHTML += "<td><button class='mdl-button mdl-js-button mdl-button--raised' onclick='updateAdminAccount(" + currentAdmin.login_id + ", \"" + currentAdmin.username + "\");'>Update</button></td></tr>";
                      displayAdminHTML += "</tr>";

                    }
                    document.getElementById("showAdmins").innerHTML = displayAdminHTML;

                    //console.log("Retrieved XML successfully");

                } else {
                    //console.log("Check the AJAX Request URL, because it's returning null.");
                }
            }
        }

        //GET requests could return a cached result, so to avoid this we use ?t=" + Math.random() after the url (random id)

        var apiURL = "http://localhost/SixthFormApplication/db/loadAccountsService.php";
        xmlhttp.open("GET", apiURL, true);
        //console.log("Retrieving Data from: ", apiURL);
        xmlhttp.send();
    }

    loadData();
});
