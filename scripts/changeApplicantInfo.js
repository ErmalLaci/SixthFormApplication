$(document).ready(function () {
    $("#submit-changs").click(function () {

        console.log();

        $.post("../db/changeApplicantInfo.php", {
            g: g
        }, function (result) {
            console.log();
        });


    });
});