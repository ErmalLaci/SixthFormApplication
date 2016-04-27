$("#ApplicationForm").submit(function(event) {
  var elements = [];
  var noError = true;
  var errorMsg = "";

  event.preventDefault();

  elements = document.getElementsByClassName("input-varchar");
  for (i = 0; i < elements.length; i++) {
    if (elements[i].value == "") {
      errorMsg += "You must fill every field. ";
      break;
    }
  }

  var postcodere = new RegExp("^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$");
  elements = document.getElementsByClassName("postcode");
  for (i = 0; i < elements.length; i++) {
    if (!(postcodere.test(elements[i].value))) {
      errorMsg += "You entered an invalid postcode. ";
      break;
    }
  }

  var emailre = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
  elements = document.getElementsByClassName("email");
  var uniqueEmail = elements[0].value;
  for (i = 0; i < elements.length; i++) {
    if (!(emailre.test(elements[i].value))) {
      errorMsg += "You entered an invalid email. ";
      break;
    }
  }

  var phonere = new RegExp("^(\\+44\\s?7\\d{3}|\\(?07\\d{3}\\)?)\\s?\\d{3}\\s?\\d{3}$");
  elements = document.getElementsByClassName("phone");
  for (i = 0; i < elements.length; i++) {
    if (!(phonere.test(elements[i].value))) {
      errorMsg += "You entered an invalid phone number. ";
      break;
    }
  }

  var namere = new RegExp("^([ \u00c0-\u01ffa-zA-Z'\-])+$");
  elements = document.getElementsByClassName("name");
  for (i = 0; i < elements.length; i++) {
    if (!(namere.test(elements[i].value))) {
      errorMsg += "You entered an invalid name. ";
      break;
    }
  }

  var subjects = [];
  var examboards = [];
  var yeartakens = [];
  for (i = 0; i < 13; i++) {
    subjects[i] = document.getElementById("subject-" + i + "-input").value;
    examboards[i] = document.getElementById("exam_board-" + i + "-input").value;
    yeartakens[i] = document.getElementById("year_taken-" + i + "-input").value;
    if (subject[i] != "" && yeartakens[i]){
      errorMsg += "You must enter the year taken. ";
    }
  }
  var subjectjson = JSON.stringify(subjects);
  var examboardjson = JSON.stringify(examboards);

  var displayError = function displayError(data){
    errorMsg += data;
    console.log(errorMsg);
    //errorMsg = "";
    if (errorMsg != "") {
      document.getElementById("applicationError").innerHTML = errorMsg;

    } else {
      $("#ApplicationForm").unbind('submit').submit();
    }
  }

  $.post("../db/applySubjectsValidation.php", {
    subjectjson: subjectjson,
    examboardjson: examboardjson,
    uniqueEmail: uniqueEmail
  }, displayError);
});
