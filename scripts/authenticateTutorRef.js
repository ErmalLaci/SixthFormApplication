$("#TutorReferenceForm").submit(function(event) {
  var tutorAuthenticator = document.getElementById("tutorAuthenticatorInput").value //get tutor authenticator input

  event.preventDefault(); //stop form from submitting

  $.post("../db/authenticateTutor.php", { //post string to php
    tutorAuthenticator: tutorAuthenticator
  }, function (result) {  //declare function to get value from post, data is value returned by php
    if (result == "Error") {
      document.getElementById("errorDisplayDiv").innerHTML = "The tutor authenticator is invalid."; //display error
    } else {
      $("#TutorReferenceForm").unbind('submit').submit(); //if there were no errors let form submit
    }
  });
});
