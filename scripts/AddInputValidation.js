function ValidateInput() {
    var Type = document.getElementById("addInputType").value;
    var Error = "";
    var noError = true;
    var Name = document.getElementById("addInputName").value;
    var Length = document.getElementById("addInputLength").value;

    if (Name == "") {
        Error += "You must input a name. ";
    }

    if (Type == "VARCHAR") {
        if (Length == "") {
            Error += "You must input a length. ";
        }
        if (typeof Length == "number") {
            Error += "The length of a varchar must be a number. "
        }
    } else if (Type == "INT") {
        if (Length == "") {
            Error += "You must input a length. ";
        }
        if (typeof Length == "number") {
            Error += "The length of a varchar must be a number. "
        }
    } else if (Type == "TEXT") {
        if (Length != "") {
            Error += "You must not input a length. ";
        }
    } else if (Type == "ENUM") {
        if (!(Length.includes(","))) {
            Error += "You must input options. ";
        }
    } else if (Type == "BIT") {
        if (Length != "") {
            Error += "You must not input a length. ";
        }
    } else if (Type == "YEAR") {
        if (!(Length.includes("-"))) {
            Error += "You must input a time frame. ";
        }
    }


    if (Error != "") {
        document.getElementById("errorDisplay").innerHTML = Error;
        //alert(Error);
        noError = false;
    }
    console.log(noError);
    return noError;
}