$("#ApplicationForm").submit(function(event) {  //run function when form is submitted
  var elements = []; //create elements array to store array of inputs class
  var errorMsg = ""; //create string variable to store error message
  event.preventDefault(); //stop form from submitting

  elements = document.getElementsByClassName("input-varchar"); //make elements array equal to inputs that are varchar
  for (i = 0; i < elements.length; i++) { //loop through all the varchar inputs
    if (elements[i].value == "") { //check if the input is empty
      errorMsg += "You must fill every field. "; //if the input is empty then display error you must fill fields
      break; //end loop
    }
  }

  var postcodeRe = new RegExp("^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$"); //regular expression for valid postcodes in the UK
  elements = document.getElementsByClassName("postcode"); //create array with all postcodes
  for (i = 0; i < elements.length; i++) { //loop through all postcodes
    if (!(postcodeRe.test(elements[i].value))) { //if postcodes don't match regex
      errorMsg += "You entered an invalid postcode. "; //display error
      break; //end loop
    }
  }

  var emailRe = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?"); //regex for email
  elements = document.getElementsByClassName("email"); //create array with all emails
  var uniqueEmail = elements[0].value; //the first email input must be unique, stores its value to pass to php
  for (i = 0; i < elements.length; i++) { //loop through all emails
    if (!(emailRe.test(elements[i].value))) { //check if values don't match regex
      errorMsg += "You entered an invalid email. "; //display error
      break; //end loop
    }
  }

  var phoneRe = new RegExp("^(\\+44\\s?7\\d{3}|\\(?07\\d{3}\\)?)\\s?\\d{3}\\s?\\d{3}$"); //regex for valid phone numbers in the uk
  elements = document.getElementsByClassName("phone"); //create array with all phone numbers
  for (i = 0; i < elements.length; i++) { //loop through phone numbers
    if (!(phoneRe.test(elements[i].value))) { //check if numbers don't match regex
      errorMsg += "You entered an invalid phone number. "; //display error
      break; //end loop after
    }
  }

  var nameRe = new RegExp("^([ \u00c0-\u01ffa-zA-Z'\-])+$"); //regex for valid names
  elements = document.getElementsByClassName("name"); //create array with all names
  for (i = 0; i < elements.length; i++) { //loop through all names
    if (!(nameRe.test(elements[i].value))) { //check if names don't match regex
      errorMsg += "You entered an invalid name. "; //display error
      break; //end loop
    }
  }

  var subjects = []; //create array to store subjects
  var examBoards = []; //create array to store exam boards
  var yearTakens = []; //create array to store year taken inputs
  var predictedGrades = []; //create array to store predicted grades
  var mockResult = [];
  var actualResult = [];
  for (i = 0; i < 13; i++) { //loop through maximum amount of subject -- 13 rows in input table
    subjects[i] = document.getElementById("subject-" + i + "-input").value.toUpperCase(); //get subject from input, store appropriate value of subject in appropriate index of array
    examBoards[i] = document.getElementById("exam_board-" + i + "-input").value.toUpperCase(); //get exam board from input, store appropriate value of exam board in appropriate index of array
    yearTakens[i] = document.getElementById("year_taken-" + i + "-input").value; //get year taken from input, store appropriate value of year taken in appropriate index of array
    predictedGrades[i] = document.getElementById("predicted_grade-" + i + "-input").value.toUpperCase(); //get predicted grade from input, store appropriate value of predicted grade in appropriate index of array
    mockResult[i] = document.getElementById("mock_result-" + i + "-input").value.toUpperCase(); //get mock result from input, store appropriate value of mock result in appropriate index of array
    actualResult[i] = document.getElementById("actual_result-" + i + "-input").value.toUpperCase(); //get actual result from input, store appropriate value of actual result in appropriate index of array

    if(subjects[i] == "" && (examBoards[i] != "" || yearTakens[i] != "" || predictedGrades[i] != "" || mockResult[i] != "" || actualResult[i] != "")){  //check if any of the options in a grades input have been filled in but subject wasn't
      errorMsg += "You must enter the subject of input " + (i + 1) + ". "; //display error
      break;
    } else if(subjects[i] != "" && examBoards[i] == ""){  //check if the exam board of a subject was left empty
      errorMsg += "You must enter the exam board of input " + (i + 1) + ". "; //display error
      break;
    } else if (subjects[i] != "" && yearTakens[i] == "") { //check if subject has a value but year taken doesn't
      errorMsg += "You must enter the year taken of input " + (i + 1) + ". "; //display error
      break;
    } else if (subjects[i] != "" && yearTakens[i].length != 4){
      errorMsg += "You must enter a valid year taken of input " + (i + 1) + ". "; //display error
      break;
    } else if (subjects[i] != "" && (predictedGrades[i] == "" || (predictedGrades[i] != "A*" && predictedGrades[i] != "A" && predictedGrades[i] != "B" && predictedGrades[i] != "C" && predictedGrades[i] != "D" && predictedGrades[i] != "E" && predictedGrades[i] != "F" && predictedGrades[i] != "G" && predictedGrades[i] != "U"))) { //check if subject has a value but predicted grade doesn't
      errorMsg += "You must enter a valid predicted grade of input " + (i + 1) + ". "; //display error
      break;
    } else if (subjects[i] != "" && (mockResult[i] != "A*" && mockResult[i] != "A" && mockResult[i] != "B" && mockResult[i] != "C" && mockResult[i] != "D" && mockResult[i] != "E" && mockResult[i] != "F" && mockResult[i] != "G" && mockResult[i] != "U")) { //check mock result has an invalid value
      errorMsg += "You must enter a valid mock result of input " + (i + 1) + ". "; //display error
      break;
    } else if (subjects[i] != "" && (actualResult[i] != "A*" && actualResult[i] != "A" && actualResult[i] != "B" && actualResult[i] != "C" && actualResult[i] != "D" && actualResult[i] != "E" && actualResult[i] != "F" && actualResult[i] != "G" && actualResult[i] != "U")) { //check mock result has an invalid value
      errorMsg += "You must enter a valid actual result of input " + (i + 1) + ". "; //display error
      break;
    }
  }
  var subjectJson = JSON.stringify(subjects); //turn subjects from array to json string
  var examBoardJson = JSON.stringify(examBoards); //turn examBoards from array to json string
  var blockAOption = ""; //declare empty block a option variable
  var blockBOption = ""; //declare empty block b option variable
  var blockCOption = ""; //declare empty block c option variable
  var blockDOption = ""; //declare empty block d option variable
  var blockEOption = ""; //declare empty block e option variable


  if ($("input[name=blockA-options]:checked").length > 0 && $("input[name=blockA-options]:checked").length > 0 && $("input[name=blockC-options]:checked").length > 0 && $("input[name=blockD-options]:checked").length > 0 && $("input[name=blockE-options]:checked").length > 0) { //check an option was selected in each block
    blockAOption = document.querySelector('input[name="blockA-options"]:checked').value; //get the value of chosen block a subject
    blockBOption = document.querySelector('input[name="blockB-options"]:checked').value; //get the value of chosen block b subject
    blockCOption = document.querySelector('input[name="blockC-options"]:checked').value; //get the value of chosen block c subject
    blockDOption = document.querySelector('input[name="blockD-options"]:checked').value; //get the value of chosen block d subject
    blockEOption = document.querySelector('input[name="blockE-options"]:checked').value; //get the value of chosen block e subject
    checkEquality = new Set(); //create set
    checkEquality.add(blockAOption); //add all options to set
    checkEquality.add(blockBOption);
    checkEquality.add(blockCOption);
    checkEquality.add(blockDOption);
    checkEquality.add(blockEOption);

    if (checkEquality.size != 5) { //sets only store unique data so if the sets size isn't 5 then the same subject was chosen in multiple blocks
      errorMsg += "You can't select the same subject in more than one block. "; //display error
    }
  } else { //not all the block had a checked option
    errorMsg += "You must select an option in each block, only level 2 subjects are optional. "; //display error
  }

  //errorMsg = "";
  if (errorMsg == "") {  //check if there is an error
    var displayError = function displayError(data) { //declare function to get value from post, data is value returned by php
      errorMsg += data; //add error message returned by php
      if (errorMsg != "") { //check if there were any errors
        document.getElementById("applicationError").innerHTML = errorMsg; //display the error message
      } else {
        $("#ApplicationForm").unbind('submit').submit(); //if there were no errors let form submit
      }
    }
    $.post("../db/applySubjectsValidation.php", { //use jquery to post data to php
      subjectJson: subjectJson, //pass subjectJson string
      examBoardJson: examBoardJson, //pass examBoardJson string
      uniqueEmail: uniqueEmail //pass unique email
    }, displayError); //call display error function
  } else {
    document.getElementById("applicationError").innerHTML = errorMsg; //display the error message
  }
});
