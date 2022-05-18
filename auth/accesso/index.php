<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trivia Stack</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

    <!-- Style -->
    <link rel="stylesheet" href="../../src/css/general.css" />
    <link rel="stylesheet" href="./accesso.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./enterClicked.js"></script>

    <!-- favicon -->
    <link rel="shortcut icon" href="../../src/images/logo.png" />

</head>

<body>

    <!-- NAVBAR -->
    <div class="barra-nav">
        <div class="barra-nav-logo">
            <a href="../../">
                <img src="../../src/images/logo.png" alt="Logo Trivia Stack" />
            </a>
        </div>
        <div class="barra-nav-menu">
            <a href="../../classifica/">Classifica</a>
            <a href="../../sfida/">Sfide</a>
            <a href="../../contatti/">Contatti</a>
        </div>
        <div class="barra-nav-user">
            <?php
            if (isset($_COOKIE['userArray'])) {
                header("Location: ../../");
            } else {
                echo "<a class='login' href='./'>Accedi</a>";
                echo "<a class='button' href='../registrazione/'>Registrati</a>";
            }
            ?>
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
                    <p>Accedi <span class="pressEnter">- Premi <i>Invio</i> per confermare</span></p>
                </div>
                <div class="window-bar-buttons">
                    <img src="../../src/images/icons/minimize.svg" alt="Minimize">
                    <img src="../../src/images/icons/maximize.svg" alt="Maximize">
                    <a href="../../"><img src="../../src/images/icons/close.svg" alt="Close"></a>
                </div>
            </div>
            <form class="form" action="./accedi.php" method="post" onsubmit="">
                <div class="utenteNotFound">
                    <?php
                    if (isset($_GET['utente'])) {
                        if ($_GET['utente'] == "false") {
                            echo "<p>Username o password errati!</p>";
                        }
                    }
                    ?>
                </div>
                <div id="divUsername" class="form-elem">
                    <label for="username"><span class="dominio">trivia@accesso</span>:<span class="root">/username</span>$></label>
                    <input type="text" id="username" name="username" placeholder="Inserisci il tuo username" onkeypress="usernamePressed(event)" autofocus />
                </div>
                <small id="smallUsername"></small>
                <div id="divPassword" class="form-elem">
                    <label for="password"><span class="dominio">trivia@accesso</span>:<span class="root">/password</span>$></label>
                    <input type="password" id="password" name="passwordUtente" placeholder="Inserisci la tua password" onkeypress="passwordPressed(event)" />
                </div>
                <small id="smallPassword"></small>
                <div id="divSubmit" class="form-elem">
                    <button name="accesso" id="submit" class="submit" type="submit" disabled>
                        Accedi
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>