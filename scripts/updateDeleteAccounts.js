function deleteAccount(id){
  $.post("../db/deleteAccount.php", {
      id: id
  }, function (result) {
      //console.log(result);
      location.reload();
  });
}
function updateTeacherAccount(id, ogusername){
  var username = document.getElementById("teacherusername" + id).value;
  var password = document.getElementById("teacherpassword" + id).value;
  var fname = document.getElementById("teacherfname" + id).value;
  var sname = document.getElementById("teachersname" + id).value;
  var department = document.getElementById("teacherdepartment" + id).value;
  var usernameChanged = "false";

  if (ogusername != username){
    usernameChanged = "true"
  }

  $.post("../db/updateTeacherAccount.php", {
      id: id,
      username: username,
      password: password,
      fname: fname,
      sname: sname,
      department: department,
      usernameChanged: usernameChanged
  }, function (result) {
    if (result == ""){
      location.reload();
    } else {
      document.getElementById("updateTeacherError").innerHTML = result;
    }
  });
}
function updateAdminAccount(id, ogusername){
  var username = document.getElementById("adminusername" + id).value;
  var password = document.getElementById("adminpassword" + id).value;
  var usernameChanged = "false";

  if (ogusername != username){
    usernameChanged = "true"
  }

  $.post("../db/updateAdminAccount.php", {
      id: id,
      username: username,
      password: password,
      usernameChanged: usernameChanged
  }, function (result) {
    if (result == ""){
      location.reload();
    } else {
      document.getElementById("updateAdminError").innerHTML = result;
    }
  });
}
function addDepartment(){
  var errorMsg = "";
  var department = document.getElementById("addDepartment").value;

  for (i = 0; i < departments.length; i++){
    if (department == departments[i]){
      errorMsg = "This department already exists.";
    }
  }

  if (errorMsg == ""){
    var departmentjson = JSON.stringify(departments);

    $.post("../db/addDepartment.php", {
      department: department,
      departmentjson: departmentjson
    }, function (result) {
      console.log(result);
      location.reload();
    });
  } else {
    document.getElementById("addDepartmentError").innerHTML = errorMsg;

  }
}
