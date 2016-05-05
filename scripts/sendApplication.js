function login(){ //function for logging in
  var usernameLogin = document.getElementById("usernamelogin").value; //get username
  var passwordLogin = document.getElementById("passwordlogin").value; //get password

  $.post("../db/userLogin.php", { //post username and password to php
    usernameLogin: usernameLogin,
    passwordLogin: passwordLogin
  }, function(result){
    console.log(result);
    if (result == "fail"){  //check if result equals fail, if it is then there was an error
      document.getElementById("showLoginError").innerHTML = "The username or password is incorrect."; //display error
    } else if (result == "applicant"){  //check if result equals applicant, if it it then the user is logging into an applicant account
      window.location.href = 'http://localhost/SixthFormApplication/views/applicantloginpage.php';  //sends applicant to applicant login page
    } else if (result == "admin"){  //check if result equals teacher, if it it then the user is logging into an teacher account
      window.location.href = 'http://localhost/SixthFormApplication/views/adminloginpage.php';  //sends admin to admin login page
    } else if (result == "teacher"){  //check if result equals teacher, if it it then the user is logging into an teacher account
      window.location.href = 'http://localhost/SixthFormApplication/views/teacherloginpage.php';  //sends teacher to teacher login page
    }
  });
}
