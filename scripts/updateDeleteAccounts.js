function deleteAccount(id) { //function to delete teacher and admin accounts, login id passed to function
  $.post("../db/deleteAccount.php", { //post id to php
    id: id
  }, function(result) {
    location.reload(); //refresh page
  });
}

function updateTeacherAccount(id, ogUsername) { //function updates teacher account, passes id and original username
  var username = document.getElementById("teacherusername" + id).value; //get input values
  var password = document.getElementById("teacherpassword" + id).value;
  var fName = document.getElementById("teacherfname" + id).value;
  var sName = document.getElementById("teachersname" + id).value;
  var department = document.getElementById("teacherdepartment" + id).value;
  var usernameChanged = "false"; //create var to check if username was changed, string so there are no error passing to php

  if (ogUsername != username) { //check if username has changed
    usernameChanged = "true"; //if username change make this true
  }
  if (username == "" || password == "" || fName == "" || sName == "" || department == "") { //check if any inputs are empty
    if (username == "") { //check which input is empty and display appropriate error message
      document.getElementById("updateTeacherError").innerHTML = "You must enter a username.";
    } else if (password == "") {
      document.getElementById("updateTeacherError").innerHTML = "You must enter a password.";
    } else if (fName == "") {
      document.getElementById("updateTeacherError").innerHTML = "You must enter a first name.";
    } else if (sName == "") {
      document.getElementById("updateTeacherError").innerHTML = "You must enter a surname.";
    } else if (department == "") {
      document.getElementById("updateTeacherError").innerHTML = "You must enter a department.";
    }
    document.getElementById("displayTeacherCreationError").innerHTML = errorMsg; //display error
  } else {
    $.post("../db/updateTeacherAccount.php", { //post values to php
      id: id,
      username: username,
      password: password,
      fName: fName,
      sName: sName,
      department: department,
      usernameChanged: usernameChanged
    }, function(result) {
      if (result == "") { //check if result is empty, if not there is an error
        location.reload(); //refresh the page
      } else {
        document.getElementById("updateTeacherError").innerHTML = result; //display error
      }
    });
  }
}

function updateAdminAccount(id, ogUsername) { //function updates admin account, passes id and original username
  var username = document.getElementById("adminusername" + id).value; //get input values
  var password = document.getElementById("adminpassword" + id).value;
  var usernameChanged = "false"; //create var to check if username was changed, string so there are no error passing to php

  if (ogUsername != username) { //check if username has changed
    usernameChanged = "true"; //if username change make this true
  }
  if (username == "" || password == "") {
    //if username or password wasn't set check which one wasn't set
    if (username == ""){
      document.getElementById("updateAdminError").innerHTML = "You must enter a username."; //display error if username wasn't set
    } else {
      document.getElementById("updateAdminError").innerHTML = "You must enter a password."; //display error if password wasn't set
    }
  } else {
    $.post("../db/updateAdminAccount.php", { //post values to php
      id: id,
      username: username,
      password: password,
      usernameChanged: usernameChanged
    }, function(result) {
      if (result == "") { //check if result is empty, if not there is an error
        location.reload(); //refresh the page
      } else {
        document.getElementById("updateAdminError").innerHTML = result; //display error
      }
    });
  }
}

function addDepartment() { //function to add department
  var errorMsg = "";
  var department = document.getElementById("addDepartment").value; //get input value

  for (i = 0; i < departments.length; i++) { //loop through global variable departments
    if (department == departments[i]) { //checks if any existing departments are equal to the input
      errorMsg = "This department already exists."; //create error
    }
  }

  if (errorMsg == "") { //check if there is no error
    var departmentJson = JSON.stringify(departments); //turn array into json string
    $.post("../db/addDepartment.php", { //post values to php
      department: department,
      departmentJson: departmentJson
    }, function(result) {
      location.reload(); //refresh the page
    });
  } else {
    document.getElementById("addDepartmentError").innerHTML = errorMsg; //display error

  }
}
