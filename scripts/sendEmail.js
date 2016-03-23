$(document).ready(function() {
    $("#resetPassBtn").click(function() {
        console.log("reset");
        var email = $("#resetpassemail").val();
        console.log(email);
        $.post("../db/sendEmail.php", {
            email: email
        }, function(result) {
            $("#displayResetEmailError").text(result);
        });    
    });
});
