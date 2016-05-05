function displayNewsFunction(name, news) {  //function to display message, name of message and contents passed to function

    var displayBox = document.getElementById("messagesdisplaydivs");
    var composeBox = document.getElementById("messagescomposedivs");

    var msgName = document.getElementById("nameOfMessageDiv");
    var msg = document.getElementById("contentOfNews");


        msgName.innerHTML = name; //display name in name div
        msg.innerHTML = news; //display message in message div

    if (displayBox.style.display == "block"){ //check if div is visible
        if (msgName.innerHTML == name && msg.innerHTML == msg){
            displayBox.style.display = "none";  //stop div from being visible
        }
    } else {
        displayBox.style.display = "block"; //make div visible
        if (composeBox.style.display == "block"){ //check if display for sending messages is visible
            composeBox.style.display = "none";  //hide compose message display
        }
    }
}

function composeMessageFunction() { //function for displaying send message box
    var displayBox = document.getElementById("messagesdisplaydivs");
    var composeBox = document.getElementById("messagescomposedivs");

    if (composeBox.style.display == "block"){ //check if compose message display is visible
        composeBox.style.display = "none";  //hide compose message display
    } else {
        if (displayBox.style.display == "block"){ //check if dispay message box is visible
            displayBox.style.display = "none";  //hide display message box
        }
        composeBox.style.display = "block"; //make compose box display visible
    }

}

function addRecipientsFunction(newRecipient) {  //function for adding recipients to message
    if (event.keyCode == 32) {  //check if spacebar is pressed
        previousRecipients = document.getElementById('displayAllRecipients').innerHTML;

        allRecipients = previousRecipients;   //store all recipients entered before
        if (allRecipients.length === 0) { //check if no recipients have been entered
            allRecipients = newRecipient; //store value of new recipient
        } else {
            allRecipients = previousRecipients + "," + newRecipient;  //store string displaying previous recipients and new recipient
        }
        document.getElementById('displayAllRecipients').innerHTML = allRecipients;  //display recipients
        document.getElementById('messageRecipientInput').value = "";  //reset input for recipients
    }
}
