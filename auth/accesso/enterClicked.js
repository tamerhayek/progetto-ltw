function usernamePressed(event) {
    if (event.keyCode == 13) {
        if ($("#username").val() != "") {
            $("#smallUsername").text("");
            $("#divPassword").css("visibility", "visible");
            $("#password").focus();
        } else {
            $("#smallUsername").text("Questo campo non può essere vuoto!");
            $("#smallUsername").css("visibility", "visible");
        }
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
