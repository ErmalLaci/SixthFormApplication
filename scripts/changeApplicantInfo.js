function deleteApplication(applicant_id){

  $.post("../db/deleteApplication.php", {
    applicant_id: applicant_id
  }, function(result){
    //console.log(result);
    location.reload();
  });

}
function validateToSendChanges(applicant_id, order, numOfCustomInputs) {
  var elements = [];
  var errorMsg = "";

  elements = document.getElementsByClassName("input-varchar applicant" + order);
  for (i = 0; i < elements.length; i++) {
    if (elements[i].value == "") {
      errorMsg += "You must fill every field. ";
      break;
    }
  }

  var postcodere = new RegExp("^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$");
  elements = document.getElementsByClassName("postcode applicant" + order);
  for (i = 0; i < elements.length; i++) {
    if (!(postcodere.test(elements[i].value))) {
      errorMsg += "You entered an invalid postcode. ";
      break;
    }
  }

  var emailre = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
  elements = document.getElementsByClassName("email applicant" + order);
  var uniqueEmail = elements[0].value;
  for (i = 0; i < elements.length; i++) {
    if (!(emailre.test(elements[i].value))) {
      errorMsg += "You entered an invalid email. ";
      break;
    }
  }

  var phonere = new RegExp("^(\\+44\\s?7\\d{3}|\\(?07\\d{3}\\)?)\\s?\\d{3}\\s?\\d{3}$");
  elements = document.getElementsByClassName("phone applicant" + order);
  for (i = 0; i < elements.length; i++) {
    if (!(phonere.test(elements[i].value))) {
      errorMsg += "You entered an invalid phone number. ";
      break;
    }
  }

  var namere = new RegExp("^([ \u00c0-\u01ffa-zA-Z'\-])+$");
  elements = document.getElementsByClassName("name applicant" + order);
  for (i = 0; i < elements.length; i++) {
    if (!(namere.test(elements[i].value))) {
      errorMsg += "You entered an invalid name. ";
      break;
    }
  }


  var displayError = function displayError(data) {
    errorMsg += data;
    //console.log(errorMsg);
    errorMsg = "";
    if (errorMsg != "") {
      document.getElementById("applicationError").innerHTML = errorMsg;

    } else {
      sendApplicantInfoChanges(applicant_id, order, numOfCustomInputs);
    }
  }

  var subjects = [];
  var examboards = [];

  for (i = 0; i < 13; i++) {
    subjects[i] = document.getElementById("subject-" + i + "-applicant" + order).value;
    examboards[i] = document.getElementById("exam_board-" + i + "-applicant" + order).value;
  }

  var subjectjson = JSON.stringify(subjects);
  var examboardjson = JSON.stringify(examboards);

  $.post("../db/applySubjectsValidation.php", {
    applicant_id: applicant_id,
    uniqueEmail: uniqueEmail,
    subjectjson: subjectjson,
    examboardjson: examboardjson
  }, displayError);
}



function sendApplicantInfoChanges(applicant_id, order, numOfCustomInputs) {
  //  console.log(applicant_id);
  //  console.log(order);
  //  console.log(numOfCustomInputs);
  var radioInputs = [];
  var customInputValues = [];
  for (i = 0; i < numOfCustomInputs; i++) {
    //console.log("applicant" + order + "input" + i);
    try {
      customInputValues[i] = document.getElementById("applicant" + order + "input" + i).value;
    } catch (err) {
      radioInputs = document.getElementsByName("applicant" + order + "input" + i);
      for (var x = 0; x < radioInputs.length; x++) {
        if (radioInputs[x].checked == true) {
          customInputValues[i] = radioInputs[x].value;
        }
      }
    }
  }

  customInputValues = JSON.stringify(customInputValues);

  var studentachievements = document.getElementById("applicant" + order + "studentsAchievements").value;
  radioInputs = document.getElementsByName("applicant" + order + "options-learningneeds");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var learningneeds = radioInputs[x].value;
    }
  }
  var learningNeedsDetails = document.getElementById("applicant" + order + "learningneeds-details").value;
  radioInputs = document.getElementsByName("applicant" + order + "options-learningsupport");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var learningsupport = radioInputs[x].value;
    }
  }
  var learningSupportDetails = document.getElementById("applicant" + order + "learningsupport-details").value;
  radioInputs = document.getElementsByName("applicant" + order + "options-statemented");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var statemented = radioInputs[x].value;
    }
  }
  var statementedDetails = document.getElementById("applicant" + order + "statemented-details").value;
  radioInputs = document.getElementsByName("applicant" + order + "options-specialconsideration");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var specialconsideration = radioInputs[x].value;
    }
  }
  var specialConsiderationDetails = document.getElementById("applicant" + order + "specialconsideration-details").value;
  radioInputs = document.getElementsByName("applicant" + order + "options-freeschoolmeals");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var freeschoolmeals = radioInputs[x].value;
    }
  }
  var tutorFirstName = document.getElementById("applicant" + order + "tutorFirstName").value;
  var tutorSurname = document.getElementById("applicant" + order + "tutorSurname").value;
  radioInputs = document.getElementsByName("applicant" + order + "options-predictedoractualgrades");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var predictedoractualgrades = radioInputs[x].value;
    }
  }
  radioInputs = document.getElementsByName("applicant" + order + "options-studentcourseinterest");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var studentcourseinterest = radioInputs[x].value;
    }
  }
  radioInputs = document.getElementsByName("applicant" + order + "options-entryrequirementsknown");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var entryrequirementsknown = radioInputs[x].value;
    }
  }
  var specialrequirementsDetails = document.getElementById("applicant" + order + "specialrequirements-details").value;
  var interviewnotesDetails = document.getElementById("applicant" + order + "interviewnotes-details").value;
  var enrichmentDetails = document.getElementById("applicant" + order + "enrichment-details").value;

  radioInputs = document.getElementsByName("applicant" + order + "options-accepted");
  for (x = 0; x < radioInputs.length; x++) {
    if (radioInputs[x].checked == true) {
      var accepted = radioInputs[x].value;
    }
  }

  var subjects = [];
  var examboards = [];
  var predictedgrade = [];
  var mockresult = [];
  var actualresult = [];
  var yeartaken = [];

  for (i = 0; i < 13; i++) {
    if (document.getElementById("subject-" + i + "-applicant" + order).value != "" && document.getElementById("exam_board-" + i + "-applicant" + order).value != "" && document.getElementById("predicted_grade-" + i + "-applicant" + order).value != "") {
      subjects[i] = document.getElementById("subject-" + i + "-applicant" + order).value;
      examboards[i] = document.getElementById("exam_board-" + i + "-applicant" + order).value;
      predictedgrade[i] = document.getElementById("predicted_grade-" + i + "-applicant" + order).value;
      mockresult[i] = document.getElementById("mock_result-" + i + "-applicant" + order).value;
      actualresult[i] = document.getElementById("actual_result-" + i + "-applicant" + order).value;
      yeartaken[i] = document.getElementById("year_taken-" + i + "-applicant" + order).value;
    }
  }
    var subjectjson = JSON.stringify(subjects);
    var examboardjson = JSON.stringify(examboards);
    var predictedgradejson = JSON.stringify(predictedgrade);
    var mockresultjson = JSON.stringify(mockresult);
    var actualresultjson = JSON.stringify(actualresult);
    var yeartakenjson = JSON.stringify(yeartaken);

    var blockAoption = $("input:radio[name='blockA-options-applicant" + order + "']:checked").val()
    var blockBoption = $("input:radio[name='blockB-options-applicant" + order + "']:checked").val()
    var blockCoption = $("input:radio[name='blockC-options-applicant" + order + "']:checked").val()
    var blockDoption = $("input:radio[name='blockD-options-applicant" + order + "']:checked").val()
    var blockEoption = $("input:radio[name='blockE-options-applicant" + order + "']:checked").val()
    var level2option = $("input:radio[name='level2-options-applicant" + order + "']:checked").val()
    var coursesReasons = document.getElementById("courses_reasons-input-applicant" + order).value;

    if (blockAoption === undefined){
      blockAoption = "NULL";
    }
    if (blockBoption === undefined){
      blockBoption = "NULL";
    }
    if (blockCoption === undefined){
      blockCoption = "NULL";
    }
    if (blockDoption === undefined){
      blockDoption = "NULL";
    }
    if (blockEoption === undefined){
      blockEoption = "NULL";
    }
    if (level2option === undefined){
      level2option = "NULL";
    }

    $.post("../db/changeApplicantInfo.php", {
      customInputValues: customInputValues,
      studentachievements: studentachievements,
      learningneeds: learningneeds,
      learningNeedsDetails: learningNeedsDetails,
      learningsupport: learningsupport,
      learningSupportDetails: learningSupportDetails,
      statemented: statemented,
      statementedDetails: statementedDetails,
      specialconsideration: specialconsideration,
      specialConsiderationDetails: specialConsiderationDetails,
      freeschoolmeals: freeschoolmeals,
      tutorFirstName: tutorFirstName,
      tutorSurname: tutorSurname,
      predictedoractualgrades: predictedoractualgrades,
      studentcourseinterest: studentcourseinterest,
      entryrequirementsknown: entryrequirementsknown,
      specialrequirementsDetails: specialrequirementsDetails,
      interviewnotesDetails: interviewnotesDetails,
      enrichmentDetails: enrichmentDetails,
      applicant_id: applicant_id,
      numOfInputs: numOfCustomInputs,
      accepted: accepted,
      subjects: subjectjson,
      examboards: examboardjson,
      predictedgrades: predictedgradejson,
      mockresults: mockresultjson,
      actualresults: actualresultjson,
      yeartakens: yeartakenjson,
      blockAoption: blockAoption,
      blockBoption: blockBoption,
      blockCoption: blockCoption,
      blockDoption: blockDoption,
      blockEoption: blockEoption,
      level2option: level2option,
      coursesReasons: coursesReasons
    }, function(result) {
      //console.log(result);
    });

  }
