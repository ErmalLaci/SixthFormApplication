function sendApplicantInfoChanges(applicant_id, order, numOfCustomInputs) {
  console.log(applicant_id);
  console.log(order);
  console.log(numOfCustomInputs);
  var radioInputs = [];
  var customInputValues = [];
  for (i = 0; i < numOfCustomInputs; i++) {
    console.log("applicant" + order + "input" + i);
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
    accepted: accepted
  }, function(result) {
    console.log(result);
  });

}
