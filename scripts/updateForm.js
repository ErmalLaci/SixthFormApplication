$(document).ready(function () {
    $("#updateFormButton").click(function () {
        var dataNum = $("#numOfInputs").text();
        console.log(dataNum);

        var name = [];
        var display = [];
        var type = [];
        var length = [];

        for (i = 0; i < dataNum; i++) {
            name[i] = $("#name" + i).val();
            console.log(name[i]);
            display[i] = $("#display" + i).val();
            console.log(display[i]);
            type[i] = $("#type" + i).val();
            console.log(type[i]);
            length[i] = $("#length" + i).val();
            console.log(length[i]);
            $.post("../db/updateform/updateInputName.php", {
                name: name[i],
            }, function (result) {
                $("#name" + i).val(result);
                //console.log(result);
            });
            $.post("../db/updateform/updateInputDisplay.php", {
                display: display[i],
                name: name[i]
            }, function (result) {
                $("#display" + i).val(result);
                console.log(result);
            });
            $.post("../db/updateform/updateInputType.php", {
                type: type[i],
                name: name[i]
            }, function (result) {
                $("#type" + i).val(result);
            });
            $.post("../db/updateform/updateInputLength.php", {
                length: length[i],
                name: name[i]
            }, function (result) {
                $("#length" + i).val(result);
            });
        }
    });
});