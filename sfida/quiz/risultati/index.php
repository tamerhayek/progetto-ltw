<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Stack | Risultati</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

    <!-- STYLE -->
    <link rel="stylesheet" href="../../../src/css/general.css">
    <link rel="stylesheet" href="./risultati.css">

    <!-- scrollreveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- favicon -->
    <link rel="shortcut icon" href="../../../src/images/logo.png" />

</head>

<body>
    <?php include '../../../src/php/logout.php'; ?>

    <!-- NAVBAR -->
    <div class="barra-nav">
        <div class="barra-nav-logo">
            <a href="../../../">
                <img src="../../../src/images/logo.png" alt="Logo Trivia Stack" />
            </a>
        </div>
        <div class="barra-nav-menu">
            <a href="../../../classifica/">Classifica</a>
            <a href="../../">Sfide</a>
            <a href="../../../contatti/">Contatti</a>
        </div>
        <div class="barra-nav-user">
            <?php
            if (isset($_COOKIE['userArray'])) {
                $data = json_decode($_COOKIE['userArray'], true);
                echo '<a class="button" href="../../../profilo/"><img src="../../../src/images/icons/profile.svg" alt="Icona Profilo">' . $data['username'] . '</a>';
                echo "<a class='login' href='?logout=true'><img class='black-icon' src='../../../src/images/icons/logout.svg'></a>";
            } else {
                header('Location: ../auth/accesso/');
            }
            ?>
        </div>
    </div>

    <?php

    if (!isset($_GET['id'])) {
        header("Location: ../../");
    }

    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $username = json_decode($_COOKIE["userArray"], 'true')['username'];

    $esito = "";

    $querySfida = "SELECT * FROM sfide WHERE id = $1";
    $querySfidaResult = pg_query_params($dbconn, $querySfida, array($_GET['id']));
    if ($sfida = pg_fetch_array($querySfidaResult, null, PGSQL_ASSOC)) {
        if ($username == $sfida['giocatore1']) {
            $avversario = $sfida['giocatore2'];
            if ($sfida['status1'] == 't' && $sfida['status2'] == 't') {
                if ($sfida['punteggio1'] > $sfida['punteggio2']) {
                    $esito = "Hai vinto!";
                } else if ($sfida['punteggio1'] < $sfida['punteggio2']) {
                    $esito = "Hai perso!";
                } else {
                    $esito = "Hai pareggiato!";
                }
            } else if ($sfida['status1'] == 't' && $sfida['status2'] == 'f') {
                $esito = "Hai finito il tuo turno! <br> L'altro giocatore deve completare la sfida.";
            } else if ($sfida['status1'] == 'f') {
                header("Location: ../?id=$_GET[id]");
            }
        } else if ($username == $sfida['giocatore2']) {
            $avversario = $sfida['giocatore1'];
            if ($sfida['status1'] == 't' && $sfida['status2'] == 't') {
                if ($sfida['punteggio1'] > $sfida['punteggio2']) {
                    $esito = "Hai perso!";
                } else if ($sfida['punteggio1'] < $sfida['punteggio2']) {
                    $esito = "Hai vinto!";
                } else {
                    $esito = "Hai pareggiato!";
                }
            } else if ($sfida['status1'] == 'f' && $sfida['status2'] == 't') {
                $esito = "Hai finito il tuo turno! <br> L'altro giocatore deve completare la sfida.";
            } else if ($sfida['status2'] == 'f') {
                header("Location: ../?id=$_GET[id]");
            }
        } else {
            header("Location: ../../");
        }
    } else {
        header("Location: ../../");
    }
    pg_free_result($querySfidaResult);

    ?>

    <div class="container zoom">

        <div class="risultato reveal">
            <div class="esito">
                <?php echo "<h2>$esito</h2>" ?>
            </div>
            <div class="riepilogo">
                <div class='punteggio'>
                    <?php echo "<span class='left'>" . $sfida['punteggio1'] . "</span><span class='center'> - </span><span class='right'>" . $sfida['punteggio2'] . "</span>"; ?>
                </div>
                <div class='giocatori'>
                    <?php echo "<span class='left'>" . $sfida['giocatore1'] . "</span><span class='center'> - </span><span class='right'>" . $sfida['giocatore2'] . "</span>"; ?>
                </div>
            </div>
        </div>


        <div class="sfide concluse reveal">
            <?php
            echo "<h3>Storico delle sfide</h3>";
            $query = 'SELECT * FROM sfide where ((giocatore1=$1 and giocatore2=$2) or (giocatore2=$1 and giocatore1=$2)) and (status1=true and status2=true) and id != $3';
            $result = pg_query_params($dbconn, $query, array($username, $avversario, $_GET['id']));
            if ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                while ($sfida) {
                    echo "<div class='sfida'>";
                    $id = $sfida['id'];
                    $giocatore1 = $sfida['giocatore1'];
                    $giocatore2 = $sfida['giocatore2'];
                    $punteggio1 = $sfida['punteggio1'];
                    $punteggio2 = $sfida['punteggio2'];
                    $vincitore = $sfida['vincitore'];
                    if (($vincitore == 1 && $giocatore1 == $username) || ($vincitore == 2 && $giocatore2 == $username)) {
                        echo "<div class='sfida-giocatore vittoria'>";
                    } else if (($vincitore == 1 && $giocatore2 == $username) || ($vincitore == 2 && $giocatore1 == $username)) {
                        echo "<div class='sfida-giocatore sconfitta'>";
                    } else {
                        echo "<div class='sfida-giocatore'>";
                    }
                    echo "<span class='left'>$giocatore1</span>";
                    echo "<span class='center'>$punteggio1 - $punteggio2</span>";
                    echo "<span class='right'>$giocatore2</span>";
                    echo "</div>";
                    echo "</div>";
                    $sfida = pg_fetch_array($result, null, PGSQL_ASSOC);
                }
            } else {
                echo "<div class='sfida'><h3>Nessuna partita precedente con questo giocatore!</h3></div>";
            }
            pg_free_result($result);
            pg_close($dbconn);
            ?>
        </div>
    </div>


    <script>
        ScrollReveal().reveal('.zoom', {
            duration: 1000,
            easing: 'cubic-bezier(.215,.61,.355, 1)',
            interval: 200,
            scale: 0.65,
            mobile: false
        });
    </script>

</body>

</html>