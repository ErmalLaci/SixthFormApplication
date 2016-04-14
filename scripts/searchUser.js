$(document).ready(function () {
    $("#searchUserBtn").click(function () {
        var username = $("#search-username-input").val();
        var id = $("#search-id-input").val();
        //console.log(username);
        //console.log(id);
        $.post("../db/searchUser.php", {
            id: id,
            username: username
        }, function (result) {
            resultArray = [];
            resultArray = result.split(",");
            console.log(resultArray[1]);
            $("#displayLoginId").text("ID " + resultArray[0]);
            $("#displayUsername").text("Username: " + resultArray[1]);
            $("#displayType").text("Type: " + resultArray[2]);
        });
    });
});