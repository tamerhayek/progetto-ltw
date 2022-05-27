function usernamePressed(event) {
    if (event.keyCode == 13) {
        if ($("#username").val() != "") {
            $("#smallUsername").text("");
            $("#divPassword").css("visibility", "visible");
            $("#password").focus();
            $("#usernameButton").css("visibility", "hidden");
            $("#usernameButton").prop("disabled", true);
        } else {
            $("#smallUsername").text("Questo campo non può essere vuoto!");
            $("#smallUsername").css("visibility", "visible");
        }
    }
}

function usernamePressedBtn() {
    if ($("#username").val() != "") {
        $("#smallUsername").text("");
        $("#divPassword").css("visibility", "visible");
        $("#password").focus();
        $("#usernameButton").css("display", "none");
        $("#usernameButton").prop("disabled", true);
        $('#submit').css("visibility", "visible");
        $('#submit').removeAttr("disabled");
    } else {
        $("#smallUsername").text("Questo campo non può essere vuoto!");
        $("#smallUsername").css("visibility", "visible");
    }
}

function passwordPressed(event) {
    if (event.keyCode == 13) {
        if ($("#password").val() != "") {
            $("#smallPassword").text("");
            $("#submit").removeAttr("disabled");
            $("#submit").click();
        } else {
            $("#smallPassword").text("Questo campo non può essere vuoto!");
            $("#smallPassword").css("visibility", "visible");
        }
    }
}