function createAdmin(){ //function for creating admin accounts
  var errorMsg = "";
  var username = document.getElementById("createAdminUsername").value;  //get input username and password
  var password = document.getElementById("createAdminPassword").value;

  if (username != "" && password != ""){  //check the username and password have values
    $.post("../db/createAdmin.php", { //post username and password the createadmin php file
      username: username,
      password: password
    }, function (result) {
      errorMsg += result; //get value of error returned from php
      if (errorMsg != ""){  //check if there is an error
        document.getElementById("displayAdminCreationError").innerHTML = errorMsg;  //dispay error
      } else {
        location.reload();  //refresh page
      }
    });
  } else {  //if username or password wasn't set check which one wasn't set
    if (username == ""){
      errorMsg += "You must enter a username."; //store error if username wasn't set
    } else {
      errorMsg += "You must enter a password."; //store error if password wasn't set
    }
    document.getElementById("displayAdminCreationError").innerHTML = errorMsg;  //display error
  }

}
function createTeacher(){ //function to create teacher account
  var errorMsg = "";
  var username = document.getElementById("createTeacherUsername").value;  //get input username, password, first name, surname and department
  var password = document.getElementById("createTeacherPassword").value;
  var fName = document.getElementById("createTeacherFname").value;
  var sName = document.getElementById("createTeacherSname").value;
  var department = document.getElementById("createTeacherDepartment").value;


  if (username != "" && password != "" && fName != "" && sName != ""){  //check if any of the inputs are empty
    $.post("../db/createTeacher.php", { //post inputs to php
      username: username,
      password: password,
      fName: fName,
      sName: sName,
      department: department
    }, function (result) {
      errorMsg += result; //store error reponse
      if (errorMsg != ""){  //check for error
        document.getElementById("displayTeacherCreationError").innerHTML = errorMsg;  //display error
      } else {
        location.reload();  //refresh page
      }
    });
  } else {
    if (username == ""){  //check which input is empty and store appropriate error message
      errorMsg += "You must enter a username.";
    } else if(password == "") {
      errorMsg += "You must enter a password.";
    }else if(fName == "") {
      errorMsg += "You must enter a first name.";
    }else if(sName == "") {
      errorMsg += "You must enter a surname.";
    }else if(department == "") {
      errorMsg += "You must enter a department.";
    }
    document.getElementById("displayTeacherCreationError").innerHTML = errorMsg;  //display error
  }
}
