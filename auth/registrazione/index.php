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
    <link rel="stylesheet" href="./registrazione.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="./validaRegistrazione.js"></script> -->
    <script src="./enterClicked.js"></script>

    <!-- favicon -->
    <link rel="shortcut icon" href="../..src/images/logo.png" />

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
                echo "<a class='login' href='../accesso/'>Accedi</a>";
                echo "<a class='button' href='./'>Registrati</a>";
            }
            ?>
        </div>
    </div>

    <!-- REGISTRAZIONE -->
    <div class="container">
        <div class="descrizione">
            <h3>Crea il tuo account e intraprendi una sfida!</h3>
            <a href='../accesso/'> Sei già registrato?</a>
        </div>
        <div class="terminale">
            <div class="window-bar">
                <div class="window-bar-title">
                    <img src="../../src/images/icons/code.svg" alt="Logo Terminale">
                    <p>Registrazione <span class="pressEnter">- Premi <i>Invio</i> per confermare</span></p>
                </div>
                <div class="window-bar-buttons">
                    <img src="../../src/images/icons/minimize.svg" alt="Minimize">
                    <img src="../../src/images/icons/maximize.svg" alt="Maximize">
                    <a href="../../"><img src="../../src/images/icons/close.svg" alt="Close"></a>
                </div>
            </div>
            <form class="form" method='POST' action="./registrati.php" onsubmit="return validaForm();">
                <div class="utenteEsistente">
                    <?php
                    if (isset($_GET['utente'])) {
                        if ($_GET['utente'] == "false") {
                            echo "<p>Utente già esistente! <a href='../accesso'>Accedi</a></p>";
                        }
                    }
                    ?>
                </div>
                <div id="divNome" class="form-elem">
                    <label for="nome"><span class="dominio">trivia@registrazione</span>:<span class="root">/nome</span>$></label>
                    <input type="text" id="nome" name="nomeUtente" placeholder="Il tuo nome" onkeypress="nomePressed(event)" autofocus />
                </div>
                <small id="smallNome"></small>
                <div id="divCognome" class="form-elem">
                    <label for="cognome"><span class="dominio">trivia@registrazione</span>:<span class="root">/cognome</span>$></label>
                    <input type="text" id="cognome" name="cognomeUtente" placeholder="Il tuo cognome" onkeypress="cognomePressed(event)" />
                </div>
                <small id="smallCognome"></small>
                <div id="divEmail" class="form-elem">
                    <label for="email"><span class="dominio">trivia@registrazione</span>:<span class="root">/email</span>$></label>
                    <input type="email" id="email" name="emailUtente" placeholder="example@mail.com" onkeypress="emailPressed(event)" />
                </div>
                <small id="smallEmail"></small>
                <div id="divUsername" class="form-elem">
                    <label for="username"><span class="dominio">trivia@registrazione</span>:<span class="root">/username</span>$></label>
                    <input type="text" id="username" name="username" placeholder="Almeno 8 caratteri" onkeypress="usernamePressed(event)" />
                </div>
                <small id="smallUsername"></small>
                <div id="divPassword" class="form-elem">
                    <label for="password"><span class="dominio">trivia@registrazione</span>:<span class="root">/password</span>$></label>
                    <input type="password" id="password" name="passwordUtente" placeholder="Almeno 8 caratteri" onkeypress="passwordPressed(event)" />
                </div>
                <small id="smallPassword"></small>
                <div id="divPasswordConf" class="form-elem">
                    <label for="passwordconferma"><span class="dominio">trivia@registrazione</span>:<span class="root">/conferma-password</span>$></label>
                    <input type="password" id="passwordconferma" name="passwordConfermaUtente" placeholder="Conferma password" onkeypress="passwordConfPressed(event)" />
                </div>
                <small id="smallPasswordConf"></small>
                <div id="divSubmit" class="divSubmit">
                    <button name="registrazione" class="submit" id="submit" type="submit" disabled>Registrami</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_GET['utente'])) {
        if ($_GET['utente'] == "false") {
            echo "<p style='color: white'>" . $_POST["nomeUtente"] . "</p>";
        }
    }
    ?>

</body>

</html>