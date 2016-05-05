$(document).ready(function() {  //check document is ready
    $("#resetPassBtn").click(function() { //run function when button is clicked
        var email = $("#resetpassemail").val(); //get input value
        $.post("../db/sendEmail.php", { //post value to php
            email: email
        }, function(result) {
            $("#displayResetEmailError").text(result);  //display error if there is one
        });
    });
});
