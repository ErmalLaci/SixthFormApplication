$(document).ready(function () {
    $("#searchUserBtn").click(function () {
        var username = $(this).closest(".mdl-textfield").find("#seach-username-input").val();
        var id = $(this).closest(".mdl-textfield").find("input:search-id-input").val();
        console.log(username);
        console.log(id);
        $.post("../db/searchUser.php", {
            id: id,
            username: username
        }, function (result) {
            result = result.split(",");
            $("#displayLoginId").val(result);
            $("#displayUsername").val(result);
            $("#displayPassword").val(result);
            $("#displayType").val(result);
        });
    });
});