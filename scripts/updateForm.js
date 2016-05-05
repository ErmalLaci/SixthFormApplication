$(document).ready(function() { //check if document is ready
  $("#updateFormButton").click(function() { //run function when button is clicked
    document.getElementById("displayUpdateError").innerHTML = ""; //display error
    var dataNum = $("#numOfInputs").text(); //get number of inputs
    var name = [];
    var display = [];
    var type = [];
    var length = [];
    var validation = [];
    var error = "";
    var res = [];

    for (i = 0; i < dataNum; i++) { //loop through all inputs
      name[i] = $("#name" + i).val(); //get values of current
      display[i] = $("#display" + i).val();
      type[i] = $("#type" + i).val();
      length[i] = $("#length" + i).val();
      validation[i] = $("#validation" + i).val();

      if (name[i] == "") { //check if name is empty
        error += "You must input a name for option " + (i + 1) + ". "; //add error to string
      } else if (display[i] == "") { //check if display is empty
        error += "You must input a display for option " + (i + 1) + ". "; //add error to string
      } else if (type[i] == "VARCHAR") { //check if type is varchar
        if (length[i] == "") { //check if length is empty
          error += "You must input a length for option " + (i + 1) + ". "; //add error to string
        }
        if (isNaN(length[i])) { //check if length is a number
          error += "The length of a varchar must be a number for option " + (i + 1) + ". "; //add error to string
        }
      } else if (type[i] == "INT") { //check if type is int
        if (length[i] == "") { //check if length is empty
          error += "You must input a length for option " + (i + 1) + ". "; //add error to string
        }
        if (isNaN(length[i])) { //check if length is a number
          error += "The length of an int must be a number for option " + (i + 1) + ". "; //add error to string
        }
      } else if (type[i] == "TEXT") { //check if type is texxt
        if (length[i] != "") { //check if length is not empty
          error += "You must not input a length for option " + (i + 1) + ". "; //add error to string
        }
      } else if (type[i] == "ENUM") { //check if type is enum
        if (!(length[i].includes(","))) { //check is length includes a comma, different options in enum should be separated by a comma
          error += "You must input options for option " + (i + 1) + ". "; //add error to string
        } else {
          res = length[i].split(","); //split length at the comma
          for (x = 0; x < res.length; x++) { //loop through all options
            if (res[x] == "") { //check if option is empty
              error += "You cannot have any empty options for option " + (i + 1) + ". " //add error to string
              break;
            }
          }
        }
      } else if (type[i] == "BIT") { //check if type is bit
        if (length[i] != "") { //check if length is not empty
          error += "You must not input a length for option " + (i + 1) + ". "; //add error to string
        }
      } else if (type[i] == "YEAR") { //check if type is year
        res = length[i].split("-"); //split length at the dash
        if (!(length[i].includes("-"))) { //check if length doesnt include a dash
          error += "You must input a time frame for option " + (i + 1) + ". "; //add error to string
        } else if (res.length != 2) { //check if res contains 2 values, length of year should be the minimum and maximum years separated by a dash
          error += "You must input a valid time frame for option " + (i + 1) + ". "; //add error to string
        } else {
          for (x = 0; x < res.length; x++) { //loop through all options
            if (res[x] == "" || isNaN(res[x]) || res[x].length != 4) { //check if option is empty or not a number or more than 4 digits long
              error += "Both inputs must be valid years for option " + (i + 1) + ". "; //add error to string
              break;
            }
          }
        }
      }
      for (x = 0; x < optionNames.length; x++){
        if (name[i] == optionNames[x] && i != x){
          error += "There is already an option with this name for option " + (i + 1) + ". ";
        }
      }
      if (error != "") { //check if there is an error
        document.getElementById("displayUpdateError").innerHTML = error; //display error
        noError = false; //change boolean value to false, this stops form submitting
      } else {
        $.post("../db/updateform/updateInput.php", { //pass values to php
          validation: validation[i],
          length: length[i],
          type: type[i],
          display: display[i],
          name: name[i],
          originalName: optionNames[i]
        }, function(result) {
          $("#error" + i).val(result); //display error
          optionNames[i] = name[i];
        });
      }
    }
  });
});
