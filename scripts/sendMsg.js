$(document).ready(function () {
    $("#sendMsgBtn").click(function () {
        
        var allRecipients = $("#displayAllRecipients").text();
        console.log(allRecipients);
        var msgname = $("#msgname").val();
        console.log(msgname);
        var msginfo = $("#msginfo").val();
        console.log(msginfo);
        
        
        $.post("../db/sendMsg.php", {
            allRecipients: allRecipients,
            msgname: msgname,
            msginfo: msginfo
        }, function(result) {
            console.log(result);
        });
        
        window.location.reload();
    });
});