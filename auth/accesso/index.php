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
        <div class="navbar">
            <div class="navbar-logo">
                <a href="../../">
                    <img src="../../src/images/logo.png" alt="Logo Trivia Stack" />
                </a>
            </div>
            <div class="navbar-menu">
            </div>
            <div class="navbar-user">
                <a class='login' href='./'>Accedi</a>
                <a class='button' href='../registrazione/'>Registrati</a>
            </div>
        </div>

        <!-- ACCEDI -->
        <div class="container">
            <div class="pannello">
                <div class="descrizione">
                    <h2>ACCESSO</h2>
                    <h3>Entra con il tuo account e intraprendi una sfida!</h3>
                    <a href="../registrazione/">Ancora non sei registrato?</a>
                </div>
                <form action="./accedi.php" method="post" onsubmit="">
                    <div class="grid">
                        <div id="divUsername" class="form-control">
                            <label for="username">Username</label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                placeholder="Inserisci il tuo username"
                                required
                            />
                        </div>
                        <div id="divPassword" class="form-control">
                            <label for="password">Password </label>
                            <input
                                type="password"
                                id="password"
                                name="passwordUtente"
                                placeholder="Inserisci la tua password"
                                required
                            />
                        </div>
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
                    <div id="divSubmit" class="divSubmit">
                        <button name="accesso" class="submit button" type="submit">
                            Accedi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
