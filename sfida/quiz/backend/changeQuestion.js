function changeQuestion(id, sfida, next) {
    if (next == 6) {
        window.location.href = "./risultati/?id=" + sfida;
    } else {
        $.post(
            "./backend/changeQuestion.php",
            { id: id, sfida: sfida },
            function (response) {
                $("#domanda").text(JSON.parse(response)["domanda"]);
                $("#risposta1").text(JSON.parse(response)["risposta1"]);
                $("#risposta2").text(JSON.parse(response)["risposta2"]);
                $("#risposta3").text(JSON.parse(response)["risposta3"]);
                $("#risposta4").text(JSON.parse(response)["risposta4"]);
                $("#prossima" + (next - 1)).css("display", "none");
                $("#prossima" + next).css("display", "block");
                $(".prossima").attr("disabled", true);
                $(".risposta").attr("disabled", false);
                $(".risposta").removeClass("correct");
                $(".risposta").removeClass("wrong");
                $("#esito").text("");
                $(".risposta").attr("disabled", false);
            }
        );
    }
}
