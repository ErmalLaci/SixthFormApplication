function apply(){
  var usernamelogin = document.getElementById("usernamelogin").value;
  var passwordlogin = document.getElementById("passwordlogin").value;

  $.post("../db/userlogin.php", {
    usernamelogin: usernamelogin,
    passwordlogin: passwordlogin
  }, function(result) {
    //console.log(result);
    if (result == "fail"){
      document.getElementById("showLoginError").innerHTML = "The username or password do not match.";
    } else if (result == "applicant"){
      window.location.href = 'http://localhost/SixthFormApplication/views/applicantloginpage.php';
    } else if (result == "admin"){
      window.location.href = 'http://localhost/SixthFormApplication/views/adminloginpage.php';
    } else if (result == "teacher"){
      window.location.href = 'http://localhost/SixthFormApplication/views/teacherloginpage.php';
    }
  });
}
