function changeQuestion(id, sfida, next) {
    if (next == 6) {
        $("#progress-bar").css("width", "100%");
        $("#progress-bar").css("border-color", "green");
        // wait 2 seconds
        setTimeout(2000);

        $.post("./backend/finish.php", { id: sfida }, function (response) {
            if (response == 1) {
                window.location.href = "./risultati/?id=" + sfida;
            } else {
                console.log(response);
            }
        });
    } else {
        if (next == 2) {
            $("#progress-bar").css("width", "20%");
            $("#progress-bar").css("border-color", "red");
        } else if (next == 3) {
            $("#progress-bar").css("width", "40%");
            $("#progress-bar").css("border-color", "orange");
        } else if (next == 4) {
            $("#progress-bar").css("width", "60%");
            $("#progress-bar").css("border-color", "yellow");
        } else if (next == 5) {
            $("#progress-bar").css("width", "80%");
            $("#progress-bar").css("border-color", "lightgreen");
        }

        $.post(
            "./backend/changeQuestion.php",
            { id: id, sfida: sfida },
            function (response) {
                // Cambia testi
                $("#domanda").text(JSON.parse(response)["domanda"]);
                $("#risposta1").text(JSON.parse(response)["risposta1"]);
                $("#risposta2").text(JSON.parse(response)["risposta2"]);
                $("#risposta3").text(JSON.parse(response)["risposta3"]);
                $("#risposta4").text(JSON.parse(response)["risposta4"]);

                // cambia on click
                document
                    .getElementById("risposta1")
                    .setAttribute(
                        "onclick",
                        "verifyQuestion(" +
                            JSON.parse(response)["id"] +
                            ",1, " +
                            sfida +
                            ")"
                    );
                document
                    .getElementById("risposta2")
                    .setAttribute(
                        "onclick",
                        "verifyQuestion(" +
                            JSON.parse(response)["id"] +
                            ",2, " +
                            sfida +
                            ")"
                    );
                document
                    .getElementById("risposta3")
                    .setAttribute(
                        "onclick",
                        "verifyQuestion(" +
                            JSON.parse(response)["id"] +
                            ",3, " +
                            sfida +
                            ")"
                    );
                document
                    .getElementById("risposta4")
                    .setAttribute(
                        "onclick",
                        "verifyQuestion(" +
                            JSON.parse(response)["id"] +
                            ",4, " +
                            sfida +
                            ")"
                    );

                // display bottoni per andare avanti
                $("#prossima" + (next - 1)).css("display", "none");
                $("#prossima" + next).css("display", "block");

                // abilita risposte e disabilita avanti
                $(".prossima").attr("disabled", true);
                $(".risposta").attr("disabled", false);

                // toglie colori corretto e sbagliato e esito
                $(".risposta").removeClass("correct");
                $(".risposta").removeClass("wrong");
                $("#esito").text("");
            }
        );
    }
}
