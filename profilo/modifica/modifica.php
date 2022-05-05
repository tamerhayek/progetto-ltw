<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        echo "<title>Trivia Stack | "."Profilo"."</title>";
    ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Style -->
    <link rel="stylesheet" href="../src/css/general.css">
    <link rel="stylesheet" href="profilo.css">
</head>
<body>
<?php include '../src/php/logout.php';?>
    <!-- NAVBAR -->
    <div class="navbar">
      <div class="navbar-logo">
        <a href="../">
          <img src="../src/images/logo.png" alt="Logo Trivia Stack" />
        </a>
      </div>
      <div class="navbar-menu">
        <a href="../classifica/">Classifica</a>
        <a href="../quiz/">Sfide</a>
        <a href="../contatti/">Contatti</a>
      </div>
      <div class="navbar-user">
        <?php 
          if (isset($_COOKIE['userArray'])) {
            $data = json_decode($_COOKIE['userArray'], true);
            echo '<a class="button" href="./"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">'.$data['username'].'</a>';
            echo "<a class='login' href='?logout=true'>Esci</a>";
          } else {
            echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
            echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
          }
        ?>
      </div>
    </div>
    
    <!-- PROFILO -->
    <div class="container">
            <div class="pannello">
                <div class="descrizione">
                    <h2>IL TUO PROFILO</h2>
                </div>
                <?php 
                    $data = json_decode($_COOKIE['userArray'], true);
                    $dbconn = pg_connect("host=localhost dbname=trivia-stack port=5432 user=postgres password=password");
                    $query = 'SELECT * from utenti where username = $1 and password = $2'; 
                    $result = pg_query_params($dbconn, $query, array($data['username'],$data['password'])); 
                    if($tuple = pg_fetch_array($result, null,PGSQL_ASSOC)){
                        $username = $tuple['username'];
                        $nome = $tuple['nome'];
                        $cognome = $tuple['cognome'];
                        $email = $tuple['email'];
                        $password = $tuple['password'];
                    }
                ?>
                <form name="formregistrazione" id="form" method='POST' action="">
                    <div class="grid">
                        <div id="divNome" class="form-control">
                            <label for="nome">Nome</label>
                            <?php
                                echo '<input type="text" id="nome" name="nomeUtente" placeholder="Il tuo nome" value='.$nome.' />';
                            ?>
                            <small></small>
                        </div>
                        <div id="divCognome" class="form-control">
                            <label for="cognome">Cognome</label>
                            <?php
                                echo '<input type="text" id="cognome" name="cognomeUtente" placeholder="Il tuo cognome" value='.$cognome.' />';
                            ?>
                            <small></small>
                        </div>
                        <div id="divEmail" class="form-control">
                            <label for="email">Email</label>
                            <?php
                                echo '<input type="text" id="email" name="emailUtente" placeholder="example@mail.com" value='.$email.' />';
                            ?>
                            <small></small>
                        </div>
                        <div id="divUsername" class="form-control">
                            <label for="username">Username</label>
                            <?php
                                echo '<input type="text" id="username" name="username" placeholder="Deve contenere almeno 8 caratteri" value='.$username.' />';
                            ?>
                            <small></small>
                        </div>
                        <div id="divPassword" class="form-control">
                            <label for="password">Password </label>
                            <input
                                type="password"
                                id="password"
                                name="passwordUtente"
                                placeholder="Deve contenere almeno 8 caratteri"
                            />
                            <small></small>
                        </div>
                        <div id="divPasswordConf" class="form-control">
                            <label for="passwordconferma"
                                >Conferma Password
                            </label>
                            <input
                                type="password"
                                id="passwordconferma"
                                name="passwordConfermaUtente"
                                placeholder="Conferma la tua password"
                            />
                            <small></small>
                        </div>
                    </div>
                    <div id="divPasswordVecchia" class="form-control">
                        <label for="passwordvecchia"
                            >Vecchia Password
                        </label>
                        <input
                            type="password"
                            id="passwordvecchia"
                            name="passwordVecchiaUtente"
                            placeholder="La tua vecchia password"
                        />
                        <small></small>
                    </div>
                    <div class="utenteEsistente">
                        <?php
                            if (isset($_GET['utente'])) {
                                if ($_GET['utente'] == "false") {
                                    echo "<p>Errore</p>";
                                }
                            }
                        ?>
                    </div>
                    <div id="divSubmit" class="divSubmit">
                        <button name="registrazione" class="submit button" type="submit">Modifica</button>
                    </div>
                </form>
            </div>
        </div>

</body>
</html>