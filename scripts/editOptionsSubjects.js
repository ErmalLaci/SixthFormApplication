function removeOptionFunction(nameofinfo){
  console.log(nameofinfo);
  $.post("../db/updateform/removeoption.php", {
    nameofinfo: nameofinfo,
  }, function(result) {
    //console.log(result);
    location.reload();
  });
}

function removeSubjectFunction(id){
  console.log(id);

  $.post("../db/removeSubject.php", {
    id: id,
  }, function(result) {
    console.log(result);
    //location.reload();
  });

}

function updateSubjectFunction(id, i){
  //console.log(id);
  var name = document.getElementById("subjectname" + i).value;
  var examboard = document.getElementById("chooseExamboard" + i).value;
  $.post("../db/updateSubject.php", {
    id: id,
    name: name,
    examboard: examboard
  }, function(result) {
    //console.log(result);
    //location.reload();
  });

}

function removesixthformSubjectFunction(id){
  console.log(id);

  $.post("../db/removeSixthFormSubject.php", {
    id: id,
  }, function(result) {
    console.log(result);
    location.reload();
  });

}

function updatesixthformSubjectFunction(id, i){
  //console.log(id);
  var name = document.getElementById("sixthformsubjectname" + i).value;
  var level = document.getElementById("chooseLevel" + i).value;
  var block = document.getElementById("chooseBlock" + i).value;
  //console.log(name + level + block);

  $.post("../db/updateSixthFormSubject.php", {
    id: id,
    name: name,
    level: level,
    block: block
  }, function(result) {
    //console.log(result);
    //location.reload();
  });

}
