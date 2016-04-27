function createAdmin(){
  var errorMsg = "";
  var username = document.getElementById("createAdminUsername").value;
  var password = document.getElementById("createAdminPassword").value;

  if (username != "" && password != ""){
    $.post("../db/createAdmin.php", {
      username: username,
      password: password
    }, function (result) {
      errorMsg += result;
      if (errorMsg != ""){
        document.getElementById("displayAdminCreationError").innerHTML = errorMsg;
      //console.log(result);
      } else {
        location.reload();
      }
    });
  } else {
    if (username == ""){
      errorMsg += "You must enter a username.";
    } else {
      errorMsg += "You must enter a password.";
    }
    document.getElementById("displayAdminCreationError").innerHTML = errorMsg;
  }

}
function createTeacher(){
  var errorMsg = "";
  var username = document.getElementById("createTeacherUsername").value;
  var password = document.getElementById("createTeacherPassword").value;
  var fname = document.getElementById("createTeacherFname").value;
  var sname = document.getElementById("createTeacherSname").value;
  var department = document.getElementById("createTeacherDepartment").value;


  if (username != "" && password != "" && fname != "" && sname != ""){
    console.log("wtf");

    $.post("../db/createTeacher.php", {
      username: username,
      password: password,
      fname: fname,
      sname: sname,
      department: department
    }, function (result) {
      //console.log(result);
      if (errorMsg != ""){
        document.getElementById("displayTeacherCreationError").innerHTML = errorMsg;
      } else {
        location.reload();
      }
    });
  } else {
    if (username == ""){
      errorMsg += "You must enter a username.";
    } else if(password == "") {
      errorMsg += "You must enter a password.";
    }else if(fname == "") {
      errorMsg += "You must enter a first name.";
    }else if(sname == "") {
      errorMsg += "You must enter a surname.";
    }else if(department == "") {
      errorMsg += "You must enter a department.";
    }
    document.getElementById("displayTeacherCreationError").innerHTML = errorMsg;
    return false;
  }
}
