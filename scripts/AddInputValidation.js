function validateInput() {  //function for validating inputs
    var type = document.getElementById("addInputType").value; //get type of new input
    var error = ""; //declare error variable
    var noError = true; //create boolean variable to return
    var name = document.getElementById("addInputName").value; //get name of new input
    var length = document.getElementById("addInputLength").value; // get length of new input
    var display = document.getElementById("addInputDisplay").value; // get display of new input

    var res = []; //declare varable res, used in validation

    for (i = 0; i < optionNames.length; i++){ //loop through all options
      if (name == optionNames[i]){  //check if name of option is taken
        error += "This is already an option. "; //add error to string
      }
    }

    if (name == "") { //check if name is empty
        error += "You must input a name. "; //add error to string
    } else if(display == ""){ //check if display is empty
      error += "You must input a display";  //add error to string
    } else if (type == "VARCHAR") { //check if type is varchar
        if (length == "") { //check if length is empty
            error += "You must input a length. "; //add error to string
        } else if (isNaN(length)) {  //check if length is a number
            error += "The length of a varchar must be a number. ";  //add error to string
        }
    } else if (type == "INT") { //check if type is int
        if (length == "") { //check if length is empty
            error += "You must input a length. "; //add error to string
        } else if (isNaN(length)) {  //check if length is a number
            error += "The length of an int must be a number. "; //add error to string
        }
    } else if (type == "TEXT") {  //check if type is texxt
        if (length != "") { //check if length is not empty
            error += "You must not input a length. "; //add error to string
        }
    } else if (type == "ENUM") {  //check if type is enum
        if (!(length.includes(","))) {  //check is length includes a comma, different options in enum should be separated by a comma
            error += "You must input options. ";  //add error to string
        } else {
          res = length.split(",");  //split length at the comma
          for (i = 0; i < res.length; i++){ //loop through all options
            if(res[i] == ""){ //check if option is empty
              error += "You cannot have any empty options. "  //add error to string
              break;
            }
          }
        }
    } else if (type == "BIT") { //check if type is bit
        if (length != "") { //check if length is not empty
            error += "You must not input a length. "; //add error to string
        }
    } else if (type == "YEAR") {  //check if type is year
        if (!(length.includes("-"))) { //check if length doesnt include a dash
            error += "You must input a time frame. "; //add error to string
        } else {

        res = length.split("-");  //split length at the dash
        if (res.length != 2){ //check if res contains 2 values, length of year should be the minimum and maximum years separated by a dash
          error += "You must input a valid time frame. "; //add error to string
        } else {
          for (i = 0; i < res.length; i++){ //loop through all options
            if(res[i] == "" || isNaN(res[i])|| res[i].length != 4){ //check if option is empty or not a number or more than 4 digits long
              error += "Both inputs must be valid years. "  //add error to string
              break;
            }
          }
        }
      }
    }

    if (error != "") { //check if there is an error
        document.getElementById("errorInputDisplay").innerHTML = error;  //display error
        noError = false;  //change boolean value to false, this stops form submitting
        console.log(noError);
    }
    return noError; //return true if there is no error and false if there is an error
}

function validateSubject() {
    var error = ""; //declare error variable
    var noError = true; //create boolean variable to return
    var name = document.getElementById("addSubjectName").value; //get name of new subject

    if (name == ""){  //check if name is empty
      error += "You must enter a name";
    }

    if (error != "") { //check if there is an error
        document.getElementById("errorSubjectDisplay").innerHTML = error;  //display error
        noError = false;  //change boolean value to false, this stops form submitting
        console.log(noError);
    }
    return noError; //return true if there is no error and false if there is an error
}

function validateSixthFormSubject() {
    var error = ""; //declare error variable
    var noError = true; //create boolean variable to return
    var name = document.getElementById("addSixthFormSubjectName").value; //get name of new sixth form subject

    if (name == ""){  //check if name is empty
      error += "You must enter a name";
    }

    if (error != "") { //check if there is an error
        document.getElementById("errorSixthFormSubjectDisplay").innerHTML = error;  //display error
        noError = false;  //change boolean value to false, this stops form submitting
    }
    return noError; //return true if there is no error and false if there is an error
}
