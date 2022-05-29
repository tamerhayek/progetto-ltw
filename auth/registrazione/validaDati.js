function validEmail(email) {
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
        email
    );
}

function nomePressed(event) {
    if (event.keyCode == 13) {
        if ($("#nome").val() != "") {
            $("#smallNome").text("");
            $("#divCognome").css("visibility", "visible");
            $("#cognome").focus();
            $("#nome").prop("readonly", true);
            $("#nomeButton").css("display", "none");
            $("#nomeButton").prop("disabled", true);
        } else {
            $("#smallNome").text("Questo campo non può essere vuoto!");
            $("#smallNome").css("visibility", "visible");
        }
    }
}
function nomePressedBtn() {
    if ($("#nome").val() != "") {
        $("#smallNome").text("");
        $("#divCognome").css("visibility", "visible");
        $("#cognome").focus();
        $("#nome").prop("readonly", true);
        $("#nomeButton").css("display", "none");
        $("#nomeButton").prop("disabled", true);
        $("#cognomeButton").css("visibility", "visible");
        $("#cognomeButton").removeAttr("disabled");
    } else {
        $("#smallNome").text("Questo campo non può essere vuoto!");
        $("#smallNome").css("visibility", "visible");
    }
}

function cognomePressed(event) {
    if (event.keyCode == 13) {
        if ($("#cognome").val() != "") {
            $("#smallCognome").text("");
            $("#divEmail").css("visibility", "visible");
            $("#email").focus();
            $("#cognome").prop("readonly", true);
            $("#cognomeButton").css("display", "none");
            $("#cognomeButton").prop("disabled", true);
        } else {
            $("#smallCognome").text("Questo campo non può essere vuoto!");
            $("#smallCognome").css("visibility", "visible");
        }
    }
}
function cognomePressedBtn() {
    if ($("#cognome").val() != "") {
        $("#smallCognome").text("");
        $("#divEmail").css("visibility", "visible");
        $("#email").focus();
        $("#cognome").prop("readonly", true);
        $("#cognomeButton").css("display", "none");
        $("#cognomeButton").prop("disabled", true);
        $("#emailButton").css("visibility", "visible");
        $("#emailButton").removeAttr("disabled");
    } else {
        $("#smallCognome").text("Questo campo non può essere vuoto!");
        $("#smallCognome").css("visibility", "visible");
    }
}

function emailPressed(event) {
    if (event.keyCode == 13) {
        if ($("#email").val() != "") {
            if (validEmail($("#email").val())) {
                $("#smallEmail").text("");
                $("#divUsername").css("visibility", "visible");
                $("#username").focus();
                $("#email").prop("readonly", true);
                $("#emailButton").css("display", "none");
                $("#emailButton").prop("disabled", true);
            } else {
                $("#smallEmail").text("Email non valida");
                $("#smallEmail").css("visibility", "visible");
            }
        } else {
            $("#smallEmail").text("Questo campo non può essere vuoto!");
            $("#smallEmail").css("visibility", "visible");
        }
    }
}
function emailPressedBtn() {
    if ($("#email").val() != "") {
        if (validEmail($("#email").val())) {
            $("#smallEmail").text("");
            $("#divUsername").css("visibility", "visible");
            $("#username").focus();
            $("#email").prop("readonly", true);
            $("#emailButton").css("display", "none");
            $("#emailButton").prop("disabled", true);
            $("#usernameButton").css("visibility", "visible");
            $("#usernameButton").removeAttr("disabled");
        } else {
            $("#smallEmail").text("Email non valida");
            $("#smallEmail").css("visibility", "visible");
        }
    } else {
        $("#smallEmail").text("Questo campo non può essere vuoto!");
        $("#smallEmail").css("visibility", "visible");
    }
}

function usernamePressed(event) {
    if (event.keyCode == 13) {
        if ($("#username").val() != "") {
            if ($("#username").val().length < 8) {
                $("#smallUsername").text(
                    "Lo username deve contenere almeno 8 caratteri!"
                );
                $("#smallUsername").css("visibility", "visible");
            } else {
                $("#smallUsername").text("");
                $("#divPassword").css("visibility", "visible");
                $("#password").focus();
                $("#username").prop("readonly", true);
                $("#usernameButton").css("display", "none");
                $("#usernameButton").prop("disabled", true);
            }
        } else {
            $("#smallUsername").text("Questo campo non può essere vuoto!");
            $("#smallUsername").css("visibility", "visible");
        }
    }
}
function usernamePressedBtn() {
    if ($("#username").val() != "") {
        if ($("#username").val().length < 8) {
            $("#smallUsername").text(
                "Lo username deve contenere almeno 8 caratteri!"
            );
            $("#smallUsername").css("visibility", "visible");
        } else {
            $("#smallUsername").text("");
            $("#divPassword").css("visibility", "visible");
            $("#password").focus();
            $("#username").prop("readonly", true);
            $("#usernameButton").css("display", "none");
            $("#usernameButton").prop("disabled", true);
            $("#passwordButton").css("visibility", "visible");
            $("#passwordButton").removeAttr("disabled");
        }
    } else {
        $("#smallUsername").text("Questo campo non può essere vuoto!");
        $("#smallUsername").css("visibility", "visible");
    }
}

function passwordPressed(event) {
    if (event.keyCode == 13) {
        if ($("#password").val() != "") {
            if ($("#password").val().length < 8) {
                $("#smallPassword").text(
                    "La password deve contenere almeno 8 caratteri!"
                );
                $("#smallPassword").css("visibility", "visible");
            } else {
                $("#smallPassword").text("");
                $("#divPasswordConf").css("visibility", "visible");
                $("#passwordconferma").focus();
                $("#password").prop("readonly", true);
                $("#passwordButton").css("display", "none");
                $("#passwordButton").prop("disabled", true);
            }
        } else {
            $("#smallPassword").text("Questo campo non può essere vuoto!");
            $("#smallPassword").css("visibility", "visible");
        }
    }
}
function passwordPressedBtn() {
    if ($("#password").val() != "") {
        if ($("#password").val().length < 8) {
            $("#smallPassword").text(
                "La password deve contenere almeno 8 caratteri!"
            );
            $("#smallPassword").css("visibility", "visible");
        } else {
            $("#smallPassword").text("");
            $("#divPasswordConf").css("visibility", "visible");
            $("#passwordconferma").focus();
            $("#password").prop("readonly", true);
            $("#passwordButton").css("display", "none");
            $("#passwordButton").prop("disabled", true);
            $("#submit").css("visibility", "visible");
            $("#submit").removeAttr("disabled");
        }
    } else {
        $("#smallPassword").text("Questo campo non può essere vuoto!");
        $("#smallPassword").css("visibility", "visible");
    }
}

function passwordConfPressed(event) {
    if (event.keyCode == 13) {
        if ($("#passwordconferma").val() != "") {
            if ($("#passwordconferma").val() !== $("#password").val()) {
                $("#smallPasswordConf").text(
                    "La password scelta e quella di conferma non coincidono!"
                );
                $("#smallPasswordConf").css("visibility", "visible");
            } else {
                $("#smallPasswordConf").text("");
                $("#submit").removeAttr("disabled");
                $("#submit").click();
            }
        } else {
            $("#smallPasswordConf").text("Questo campo non può essere vuoto!");
            $("#smallPasswordConf").css("visibility", "visible");
        }
    }
}

function validaForm() {
    if ($("#nome").val() == "") {
        return false;
    }
    if ($("#cognome").val() == "") {
        return false;
    }
    if ($("#email").val() == "") {
        return false;
    }
    if ($("#email").val() != "" && !validEmail($("#email").val())) {
        return false;
    }
    if ($("#username").val() == "") {
        return false;
    }
    if ($("#username").val().length < 8) {
        return false;
    }
    if ($("#password").val() == "") {
        return false;
    }
    if ($("#password").val().length < 8) {
        return false;
    }
    if ($("#passwordconferma").val() == "") {
        return false;
    }
    if ($("#passwordconferma").val() !== $("#password").val()) {
        return false;
    }
    return true;
}
