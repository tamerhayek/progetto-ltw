function changeQuestion(id, sfida, next) {
    if (next == 6) {
        $.post(
            "./backend/finish.php",
            { id: sfida },
            function (response) {
                if (response == 1) {
                    window.location.href = "../risultati/?id=" + sfida;
                } else {
                    window.location.href = "../../";
                }
            }
        );
    } else {
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
                document.getElementById("risposta1").setAttribute("onclick","verifyQuestion("+JSON.parse(response)['id']+",1, "+sfida+")");
                document.getElementById("risposta2").setAttribute("onclick","verifyQuestion("+JSON.parse(response)['id']+",2, "+sfida+")");
                document.getElementById("risposta3").setAttribute("onclick","verifyQuestion("+JSON.parse(response)['id']+",3, "+sfida+")");
                document.getElementById("risposta4").setAttribute("onclick","verifyQuestion("+JSON.parse(response)['id']+",4, "+sfida+")");

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
