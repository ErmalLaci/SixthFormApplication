$(document).ready(function () { //check document is ready
    $("#deletemessagebutton").click(function () { //run function when specified buttonn is clicked
        var numOfMessages = document.getElementById("AmountOfNews").innerHTML;  //get number of messages
        var deletedMessages = "";
        for (i = 0; i < numOfMessages; i++) { //loop through all messages
            if (document.getElementById("checkbox" + i).checked === false) {  //check if message was selected
                deletedMessages += "0"; //if not add a 0 to the deletedMessages string
            } else {
                deletedMessages += "1"; //if message should be deleted add a 1 to the deletedMessages string
            }
        }
        console.log(deletedMessages);
        $.post("../db/deleteMessage.php", { //post string to php
            deletedMessages: deletedMessages
        }, function (result) {
          console.log(result);
        });


    });
});
