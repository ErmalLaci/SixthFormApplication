$(document).ready(function () {
    $("#deletemessagebutton").click(function () {
        //console.log("delete messages initiated");
        var numOfMessages = document.getElementById("AmountOfNews").innerHTML;
        //console.log("num of messages: " + numOfMessages);

        var deletedmessages = "";
        for (i = 0; i < numOfMessages; i++) {
            //console.log(document.getElementById("idmessage" + i).innerHTML);
            if (document.getElementById("checkbox" + i).checked === false) {
                deletedmessages += "0";
            } else {
                console.log("Delete message");
                deletedmessages += "1";
            }
        }

        console.log(deletedmessages);
        
        $.post("../db/deletemessage.php", {
            deletedmessages: deletedmessages
        }, function (result) {
            console.log(JSON.stringify(result));
            console.log(result);
        });


    });
});