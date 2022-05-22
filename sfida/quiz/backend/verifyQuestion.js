const corretta = new Audio("../../../src/audio/correct-answer.mp3");
const errata = new Audio("../../../src/audio/wrong-answer.mp3");

corretta.volume = 0.05;
errata.volume = 0.05;

function verifyQuestion(id, risposta, sfida) {
    $.post(
        "./backend/verifyQuestion.php",
        { id: id, risposta: risposta, sfida: sfida },
        function (response) {
            //disable buttons
            $(".risposta").attr("disabled", true);

            if (response == 0) {
                $("#risposta"+risposta).addClass("correct");
                corretta.play();
            } else {
                $("#risposta"+risposta).addClass("wrong");
                $("#risposta"+response).addClass("correct");
                errata.play();
            } 
            // abilita bottone prossima
            $(".prossima").attr("disabled", false);

        }
    );
}