function removeOptionFunction(nameOfInfo) { //function to remove option, name of option passed to function
  $.post("../db/updateform/removeOption.php", { //post name of option to php
    nameOfInfo: nameOfInfo,
  }, function(result) {
    location.reload(); //refresh page
  });
}

function removeSubjectFunction(id) { //function to remove subject, id of subject passed to function

  $.post("../db/removeSubject.php", { //post id to php
    id: id,
  }, function(result) {
    location.reload(); //refresh page
  });

}

function updateSubjectFunction(id, i) { //function to update function, pass id of subject and number in html id
  var name = document.getElementById("subjectName" + i).value; //get value of subjects name and exam board
  var examBoard = document.getElementById("chooseExamboard" + i).value;
  if (name == "") { //check if name is empty
    document.getElementById("updateSubjectError").innerHTML = "You must enter a name for subject " + i;
  } else {
    $.post("../db/updateSubject.php", { //post data to php
      id: id,
      name: name,
      examBoard: examBoard
    }, function(result) {

    });
  }
}

function removesixthformSubjectFunction(id) { //function to remove sixth form subject, pass id of sixth form subject

  $.post("../db/removeSixthFormSubject.php", { //post id to php
    id: id,
  }, function(result) {
    location.reload(); //refresh the page
  });

}

function updatesixthformSubjectFunction(id, i) { //function to update function, pass id of subject and number in html id
  var name = document.getElementById("sixthFormSubjectName" + i).value; //get name, level and block of specified sixth form subject
  var level = document.getElementById("chooseLevel" + i).value;
  var block = document.getElementById("chooseBlock" + i).value;

  if (name == "") { //check if name is empty
    document.getElementById("updateSixthFormSubjectError").innerHTML = "You must enter a name for subject " + i;
  } else {
    $.post("../db/updateSixthFormSubject.php", { //post data to php
      id: id,
      name: name,
      level: level,
      block: block
    }, function(result) {
    });
  }
}
