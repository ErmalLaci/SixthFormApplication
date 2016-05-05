function deleteApplication(applicantId) { //create function for deleting application, applicant id passed to function

  $.post("../db/deleteApplication.php", { //post values to php
    applicantId: applicantId //pass applicant id
  }, function(result) { //run function after getting a result
    location.reload(); //reload page
  });

}

function validateToSendChanges(applicantId, order, numOfCustomInputs) {
  var elements = []; //create array to store values being validated in loops
  var errorMsg = ""; //create string to store error message

  elements = document.getElementsByClassName("input-varchar applicant" + order); //get all text field inputs for the applicant whose information is being changed
  for (i = 0; i < elements.length; i++) { //loop through all text field inputs
    if (elements[i].value == "") { //check if input is empty
      errorMsg += "You must fill every field. "; //store error in string
      break; //exit for loop
    }
  }

  var postcodeRe = new RegExp("^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$"); //regex for postcode
  elements = document.getElementsByClassName("postcode applicant" + order); //get all postcode inputs
  for (i = 0; i < elements.length; i++) { //loop through postcode inputs
    if (!(postcodeRe.test(elements[i].value))) { //check if postcode matches regex
      errorMsg += "You entered an invalid postcode. "; //store error in string
      break; //exit loop
    }
  }

  var emailRe = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?"); //regex for email
  elements = document.getElementsByClassName("email applicant" + order); //get all email inputs
  var uniqueEmail = elements[0].value; //get value of unique email
  for (i = 0; i < elements.length; i++) { //loop through all email inputs
    if (!(emailRe.test(elements[i].value))) { //check if email matches regex
      errorMsg += "You entered an invalid email. "; //store error in string
      break; //exit loop
    }
  }

  var phoneRe = new RegExp("^(\\+44\\s?7\\d{3}|\\(?07\\d{3}\\)?)\\s?\\d{3}\\s?\\d{3}$"); //regex for phone number
  elements = document.getElementsByClassName("phone applicant" + order); //get all phone number inputs
  for (i = 0; i < elements.length; i++) { //loop through phone number inputs
    if (!(phoneRe.test(elements[i].value))) { //check if phone number matches regex
      errorMsg += "You entered an invalid phone number. "; //store error in string
      break; //exit loop
    }
  }

  var nameRe = new RegExp("^([ \u00c0-\u01ffa-zA-Z'\-])+$"); //regex for name
  elements = document.getElementsByClassName("name applicant" + order); //get all name inputs
  for (i = 0; i < elements.length; i++) { //loop through all name inputs
    if (!(nameRe.test(elements[i].value))) { //check if name matches regex
      errorMsg += "You entered an invalid name. "; //store error in string
      break; //exit loop
    }
  }

  var subjects = []; //declare subjects array
  var examBoards = []; //declare examBoards array
  var yearTakens = []; //create array to store year taken inputs
  var predictedGrades = []; //create array to store predicted grades
  var mockResult = [];
  var actualResult = [];

  for (i = 0; i < 13; i++) { //loop through maximum amount of subject -- 13 rows in input table
    subjects[i] = document.getElementById("subject-" + i + "-applicant" + order).value.toUpperCase(); //get subject from input, store appropriate value of subject in appropriate index of array
    examBoards[i] = document.getElementById("exam_board-" + i + "-applicant" + order).value.toUpperCase(); //get exam board from input, store appropriate value of exam board in appropriate index of array
    yearTakens[i] = document.getElementById("year_taken-" + i + "-applicant" + order).value.toUpperCase(); //get year taken from input, store appropriate value of year taken in appropriate index of array
    predictedGrades[i] = document.getElementById("predicted_grade-" + i + "-applicant" + order).value.toUpperCase(); //get predicted grade from input, store appropriate value of predicted grade in appropriate index of array
    mockResult[i] = document.getElementById("mock_result-" + i + "-applicant" + order).value.toUpperCase(); //get mock result from input, store appropriate value of mock result in appropriate index of array
    actualResult[i] = document.getElementById("actual_result-" + i + "-applicant" + order).value.toUpperCase(); //get actual result from input, store appropriate value of actual result in appropriate index of array
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
    } else if (subjects[i] != "" && (predictedGrades[i] == "" || (predictedGrades[i] != "A*" && predictedGrades[i] != "A" && predictedGrades[i] != "B" && predictedGrades[i] != "C" && predictedGrades[i] != "D" && predictedGrades[i] != "E" && predictedGrades[i] != "F" && predictedGrades[i] != "G" && predictedGrades[i] != "U"))) { //check if subject has a value but predicted grade doesn't have a valid value
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

  var subjectJson = JSON.stringify(subjects); //turn subjects and examBoards array into json strings
  var examBoardJson = JSON.stringify(examBoards);

  var blockAOption = ""; //declare empty block a option variable
  var blockBOption = ""; //declare empty block b option variable
  var blockCOption = ""; //declare empty block c option variable
  var blockDOption = ""; //declare empty block d option variable
  var blockEOption = ""; //declare empty block e option variable


  if ($("input[name=blockA-options-applicant" + order + "]:checked").length > 0 && $("input[name=blockA-options-applicant" + order + "]:checked").length > 0 && $("input[name=blockC-options-applicant" + order + "]:checked").length > 0 && $("input[name=blockD-options-applicant" + order + "]:checked").length > 0 && $("input[name=blockE-options-applicant" + order + "]:checked").length > 0) { //check an option was selected in each block
    blockAOption = document.querySelector('input[name="blockA-options-applicant' + order + '"]:checked').value; //get the value of chosen block a subject
    blockBOption = document.querySelector('input[name="blockB-options-applicant' + order + '"]:checked').value; //get the value of chosen block b subject
    blockCOption = document.querySelector('input[name="blockC-options-applicant' + order + '"]:checked').value; //get the value of chosen block c subject
    blockDOption = document.querySelector('input[name="blockD-options-applicant' + order + '"]:checked').value; //get the value of chosen block d subject
    blockEOption = document.querySelector('input[name="blockE-options-applicant' + order + '"]:checked').value; //get the value of chosen block e subject
    checkEquality = new Set(); //create set
    checkEquality.add(blockAOption); //add all options to set
    checkEquality.add(blockBOption);
    checkEquality.add(blockCOption);
    checkEquality.add(blockDOption);
    checkEquality.add(blockEOption);

    if (checkEquality.size != 5) { //sets only store unique data so if the sets size isn't 5 then the same subject was chosen in multiple blocks
      errorMsg = "You can't select the same subject in more than one block. "; //display error
    }
  } else { //not all the block had a checked option
    errorMsg = "You must select an option in each block, only level 2 subjects are optional. "; //display error
  }

  if (errorMsg == "") { //check if there is an error
    var displayError = function displayError(data) { //create function, data is value returned by php
      errorMsg += data; //store returned errors from php
      if (errorMsg != "") { //check if there are errors
        document.getElementById("applicationError").innerHTML = errorMsg; //display errors
      } else { //if there are no errors
        sendApplicantInfoChanges(applicantId, order, numOfCustomInputs); //call function to change info, pass applicantId, order and numOfCustomInputs to function
      }
    }

    $.post("../db/applySubjectsValidation.php", { //post values to php
      applicantId: applicantId,
      uniqueEmail: uniqueEmail,
      subjectJson: subjectJson,
      examBoardJson: examBoardJson
    }, displayError);
  } else {
    document.getElementById("applicationError").innerHTML = errorMsg; //display the error message
  }
}



function sendApplicantInfoChanges(applicantId, order, numOfCustomInputs) {
  var radioInputs = [];
  var customInputValues = [];
  for (i = 0; i < numOfCustomInputs; i++) {
    try { //try to get the value of custom input
      customInputValues[i] = document.getElementById("applicant" + order + "input" + i).value; //get the value if there is no error
    } catch (err) { //there is an error if the input is a radio button
      radioInputs = document.getElementsByName("applicant" + order + "input" + i); //get radio button group id
      for (var x = 0; x < radioInputs.length; x++) { //loop through all radio buttons
        if (radioInputs[x].checked == true) { //check if the current radio button is true
          customInputValues[i] = radioInputs[x].value; //get value of selected radio button
        }
      }
    }
  }

  customInputValues = JSON.stringify(customInputValues); //turn array into json string

  var studentAchievements = document.getElementById("applicant" + order + "studentsAchievements").value; //get value of chosen applicants achievements
  radioInputs = document.getElementsByName("applicant" + order + "options-learningneeds"); //get id of learning needs radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var learningNeeds = radioInputs[x].value;
    }
  }
  var learningNeedsDetails = document.getElementById("applicant" + order + "learningneeds-details").value; //get value of chosen applicants learning needs
  radioInputs = document.getElementsByName("applicant" + order + "options-learningsupport"); //get id of learning support radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var learningSupport = radioInputs[x].value;
    }
  }
  var learningSupportDetails = document.getElementById("applicant" + order + "learningsupport-details").value; //get value of chosen applicants learning support
  radioInputs = document.getElementsByName("applicant" + order + "options-statemented"); //get id of statemented radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var statemented = radioInputs[x].value;
    }
  }
  var statementedDetails = document.getElementById("applicant" + order + "statemented-details").value; //get value of chosen applicants achievements
  radioInputs = document.getElementsByName("applicant" + order + "options-specialconsideration"); //get id of special consideration radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var specialConsideration = radioInputs[x].value;
    }
  }
  var specialConsiderationDetails = document.getElementById("applicant" + order + "specialconsideration-details").value; //get value of chosen special consideration
  radioInputs = document.getElementsByName("applicant" + order + "options-freeschoolmeals"); //get id of free school meals radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var freeSchoolMeals = radioInputs[x].value;
    }
  }
  var tutorFirstName = document.getElementById("applicant" + order + "tutorFirstName").value; //get value of chosen applicants tutors first name
  var tutorSurname = document.getElementById("applicant" + order + "tutorSurname").value; //get value of chosen applicants tutors surname
  radioInputs = document.getElementsByName("applicant" + order + "options-predictedoractualgrades"); //get id of entry requirements radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var predictedOrActualGrades = radioInputs[x].value;
    }
  }
  radioInputs = document.getElementsByName("applicant" + order + "options-studentcourseinterest"); //get id of student course interest radio group
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var studentCourseInterest = radioInputs[x].value;
    }
  }
  radioInputs = document.getElementsByName("applicant" + order + "options-entryrequirementsknown"); //get id of entry requirements radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var entryRequirementsKnown = radioInputs[x].value;
    }
  }
  var specialRequirementsDetails = document.getElementById("applicant" + order + "specialrequirements-details").value; //get value of chosen applicants special requirements
  var interviewNotesDetails = document.getElementById("applicant" + order + "interviewnotes-details").value; //get value of chosen applicants interview notes
  var enrichmentDetails = document.getElementById("applicant" + order + "enrichment-details").value; //get value of chosen applicants enrichment details

  radioInputs = document.getElementsByName("applicant" + order + "options-accepted"); //get id of accepted radio group
  for (x = 0; x < radioInputs.length; x++) { //loop through all radio buttons for specified radio group and store the value of the selected radio button
    if (radioInputs[x].checked == true) {
      var accepted = radioInputs[x].value;
    }
  }

  var subjects = [];
  var examBoards = [];
  var predictedGrade = [];
  var mockResult = [];
  var actualResult = [];
  var yearTaken = [];

  for (i = 0; i < 13; i++) { //loop through all grades inputs
    if (document.getElementById("subject-" + i + "-applicant" + order).value != "" && document.getElementById("exam_board-" + i + "-applicant" + order).value != "" && document.getElementById("predicted_grade-" + i + "-applicant" + order).value != "" && document.getElementById("year_taken-" + i + "-applicant" + order).value != "") { //check if subject, exam board, predicted grade and year taken have been set
      subjects[i] = document.getElementById("subject-" + i + "-applicant" + order).value; //if they have been set then get values of all inputs on this row
      examBoards[i] = document.getElementById("exam_board-" + i + "-applicant" + order).value;
      predictedGrade[i] = document.getElementById("predicted_grade-" + i + "-applicant" + order).value;
      mockResult[i] = document.getElementById("mock_result-" + i + "-applicant" + order).value;
      actualResult[i] = document.getElementById("actual_result-" + i + "-applicant" + order).value;
      yearTaken[i] = document.getElementById("year_taken-" + i + "-applicant" + order).value;
    }
  }
  var subjectJson = JSON.stringify(subjects); //turn all the arrays holding the values of the students grades into json strings
  var examBoardJson = JSON.stringify(examBoards);
  var predictedGradeJson = JSON.stringify(predictedGrade);
  var mockResultJson = JSON.stringify(mockResult);
  var actualResultJson = JSON.stringify(actualResult);
  var yearTakenJson = JSON.stringify(yearTaken);

  var blockAOption = $("input:radio[name='blockA-options-applicant" + order + "']:checked").val(); //get values of all options and reasons for selecting the course
  var blockBOption = $("input:radio[name='blockB-options-applicant" + order + "']:checked").val();
  var blockCOption = $("input:radio[name='blockC-options-applicant" + order + "']:checked").val();
  var blockDOption = $("input:radio[name='blockD-options-applicant" + order + "']:checked").val();
  var blockEOption = $("input:radio[name='blockE-options-applicant" + order + "']:checked").val();
  var level2Option = $("input:radio[name='level2-options-applicant" + order + "']:checked").val();
  var coursesReasons = document.getElementById("courses_reasons-input-applicant" + order).value;

  if (blockAOption === undefined) { //check if any of the options haven't been set, this makes them undefined
    blockAOption = "NULL"; //if the option wasnt selected make it null, this makes it usable in sql
  }
  if (blockBOption === undefined) {
    blockBOption = "NULL";
  }
  if (blockCOption === undefined) {
    blockCOption = "NULL";
  }
  if (blockDOption === undefined) {
    blockDOption = "NULL";
  }
  if (blockEOption === undefined) {
    blockEOption = "NULL";
  }
  if (level2Option === undefined) {
    level2Option = "NULL";
  }

  $.post("../db/changeApplicantInfo.php", { //post the values of all the variables to the php file
    customInputValues: customInputValues,
    studentAchievements: studentAchievements,
    learningNeeds: learningNeeds,
    learningNeedsDetails: learningNeedsDetails,
    learningSupport: learningSupport,
    learningSupportDetails: learningSupportDetails,
    statemented: statemented,
    statementedDetails: statementedDetails,
    specialConsideration: specialConsideration,
    specialConsiderationDetails: specialConsiderationDetails,
    freeSchoolMeals: freeSchoolMeals,
    tutorFirstName: tutorFirstName,
    tutorSurname: tutorSurname,
    predictedOrActualGrades: predictedOrActualGrades,
    studentCourseInterest: studentCourseInterest,
    entryRequirementsKnown: entryRequirementsKnown,
    specialRequirementsDetails: specialRequirementsDetails,
    interviewNotesDetails: interviewNotesDetails,
    enrichmentDetails: enrichmentDetails,
    applicantId: applicantId,
    numOfInputs: numOfCustomInputs,
    accepted: accepted,
    subjects: subjectJson,
    examBoards: examBoardJson,
    predictedGrades: predictedGradeJson,
    mockResults: mockResultJson,
    actualResults: actualResultJson,
    yearTakens: yearTakenJson,
    blockAOption: blockAOption,
    blockBOption: blockBOption,
    blockCOption: blockCOption,
    blockDOption: blockDOption,
    blockEOption: blockEOption,
    level2Option: level2Option,
    coursesReasons: coursesReasons
  }, function(result) {});

}
