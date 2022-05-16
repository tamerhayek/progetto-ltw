function verifyQuestion(id, risposta, sfida) {
    $.post(
        "./backend/verifyQuestion.php",
        { id: id, risposta: risposta, sfida: sfida },
        function (response) {
            //disable buttons
            $(".risposta").attr("disabled", true);

            if (response == 1) {
                $("#risposta"+risposta).addClass("correct");
                $("#esito").text("Risposta corretta!");
            } else if (response == 0) {
                $("#risposta"+risposta).addClass("wrong");
                $("#esito").text("Risposta errata!");
            } 
            // abilita bottone prossima
            $(".prossima").attr("disabled", false);

        }
    );
}