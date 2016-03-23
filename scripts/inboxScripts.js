function displayNewsFunction(name, news) {
    console.log(name);
    console.log(news);
    
    var displaybox = document.getElementById("messagesdisplaydivs");
    var composebox = document.getElementById("messagescomposedivs");
    
    var msgname = document.getElementById("nameOfMessageDiv");
    var msg = document.getElementById("contentOfNews");
    
    
        msgname.innerHTML = name;
        msg.innerHTML = news;
    
    if (displaybox.style.display == "block"){
        if (msgname.innerHTML == name && msg.innerHTML == msg){
            displaybox.style.display = "none";
        }
    } else {
        displaybox.style.display = "block";
        if (composebox.style.display == "block"){
            composebox.style.display = "none"
        }
    }
}

function composeMessageFunction() {
    var displaybox = document.getElementById("messagesdisplaydivs");
    var composebox = document.getElementById("messagescomposedivs");
    
    if (composebox.style.display == "block"){
        composebox.style.display = "none";
    } else {
        if (displaybox.style.display == "block"){
            displaybox.style.display = "none";
        }
        composebox.style.display = "block";
    }
    
}

function addRecipientsFunction(newRecipient) {
    if (event.keyCode == 32) {
        previousRecipients = document.getElementById('displayAllRecipients').innerHTML;

        allRecipients = previousRecipients;
        if (allRecipients.length === 0) {
            allRecipients = newRecipient;
        } else {
            allRecipients = previousRecipients + "," + newRecipient;
        }
        document.getElementById('displayAllRecipients').innerHTML = allRecipients;
        document.getElementById('messageRecipientInput').value = "";
    }
}
