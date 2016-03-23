function removeOptionFunction(nameofinfo){
  console.log(nameofinfo);
  $.post("../db/updateform/removeoption.php", {
    nameofinfo: nameofinfo,
  }, function(result) {
    console.log(result);
    location.reload();
  });
}
