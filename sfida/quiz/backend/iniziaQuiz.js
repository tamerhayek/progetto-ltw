function inizializzaStorage(sfida) {
    if (localStorage.getItem("quiz:" + sfida) == null) {
        localStorage.setItem("quiz:" + sfida, JSON.stringify(sfida));
    } else {
        $.post("./backend/finish.php", { id: sfida }, function (response) {
            if (response == 1) {
                window.location.href = "./risultati/?id=" + sfida;
            }
        });
    }
}
