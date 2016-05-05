$(document).ready(function () { //check document is ready
    $("#sendMsgBtn").click(function () {  //run function when button is clicked

        var allRecipients = $("#displayAllRecipients").text();  //get value of inputs
        var msgName = $("#msgname").val();
        var msgInfo = $("#msginfo").val();

        $.post("../db/sendMsg.php", { //post values to php
            allRecipients: allRecipients,
            msgName: msgName,
            msgInfo: msgInfo
        }, function(result) {
            if (result == ""){
            location.reload();  //refresh
            } else {
              alert(result);  //alert error message
              $("#displayAllRecipients").text("");  //remove all recipients
            }
        });
    });
});
