function ValidateInput() {
    var Type = "";
    var Error = "";
    var noError = true;
    Type = document.getElementById("addInputType").value;
    if (Type != "") {
        console.log(Type);
        Type = Type.toUpperCase();
        if (!(Type == "VARCHAR" || Type == "INT" || Type == "TEXT" || Type == "DATE" || Type == "BOOLEAN" || Type == "ENUM" || Type == "BIT" || Type == "YEAR")) {
            Error += "This type doesn't exist. ";
        }
    } else {
        Error += "You must input a type. ";
    }

    if (document.getElementById("addInputName").value == "") {
        Error += "You must input a name. ";
    }

    if (document.getElementById("addInputLength").value == "") {
        //Error += "You must input a length. ";
    }
    console.log(Error)
    if (Error != "") {
        alert(Error);
        noError = false;
    }
    console.log(noError);
    return noError;
}