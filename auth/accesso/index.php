<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trivia Stack | Accedi</title>

    <!-- STYLE -->
    <link rel="stylesheet" href="../../src/css/general.css" />
    <link rel="stylesheet" href="accesso.css" />
</head>

<body>
    <?php
    if (isset($_COOKIE['userArray'])) { // controllo username e password
        header("location: ../../");
    }
    ?>
    <!-- NAVBAR -->
    <div class="barra-nav">
        <div class="barra-nav-logo">
            <a href="../../">
                <img src="../../src/images/logo.png" alt="Logo Trivia Stack" />
            </a>
        </div>
        <div class="barra-nav-menu">
            <a href="../../classifica/">Classifica</a>
            <a href="../../quiz/">Sfide</a>
            <a href="../../contatti/">Contatti</a>
        </div>
        <div class="barra-nav-user">
            <a class='login' href='./'>Accedi</a>
            <a class='button' href='../registrazione/'>Registrati</a>
        </div>
    </div>

    <!-- ACCEDI -->
    <div class="container">
        <div class="descrizione">
            <h3>Entra con il tuo account e intraprendi una sfida!</h3>
            <a href="../registrazione/">Ancora non sei registrato?</a>
        </div>
        <div class="terminale">
            <div class="window-bar">
                <div class="window-bar-title">
                    <img src="../../src/images/icons/code.svg" alt="Logo Terminale">
                    <p>Login - Premi <i>Invio</i> per confermare</p>
                </div>
                <div class="window-bar-buttons">
                    <img src="../../src/images/icons/minimize.svg" alt="Minimize">
                    <img src="../../src/images/icons/maximize.svg" alt="Maximize">
                    <a href="../../"><img src="../../src/images/icons/close.svg" alt="Close"></a>
                </div>
            </div>
            <form class="form" action="./accedi.php" method="post" onsubmit="">
                <div id="divUsername" class="form-elem">
                    <label for="username"><span class="dominio">trivia-stack@login</span>:<span class="root">/username</span>$></label>
                    <input type="text" id="username" name="username" placeholder="Inserisci il tuo username" autofocus />
                </div>
                <div id="divPassword" class="form-elem">
                    <label for="password"><span class="dominio">trivia-stack@login</span>:<span class="root">/password</span>$></label>
                    <input type="password" id="password" name="passwordUtente" placeholder="Inserisci la tua password" />
                </div>
                <div class="utenteNotFound">
                    <?php
                    if (isset($_GET['utente'])) {
                        if ($_GET['utente'] == "false") {
                            echo "<p>Username o password errati!</p>";
                        }
                    }
                    ?>
                </div>
                <div id="divSubmit" class="form-elem">
                    <button name="accesso" class="submit" type="submit">
                        Accedi
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>