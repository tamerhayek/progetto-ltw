<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

    <!-- STYLE -->
  <link rel="stylesheet" href="../../../src/css/general.css">
  <link rel="stylesheet" href="risultati.css">

   
</head>
<body>
    <?php
        $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
        $username = json_decode($_COOKIE["userArray"], true)['username'];

        $querySfida = "SELECT * FROM sfide WHERE id = $1";
        $querySfidaResult = pg_query_params($dbconn, $querySfida, array($_GET['id']));
        if ($sfida = pg_fetch_array($querySfidaResult, null, PGSQL_ASSOC)) {
            $giocatore1 = $sfida['giocatore1'];
            $giocatore2 = $sfida['giocatore2'];
            $punteggio1 = $sfida['punteggio1'];
            $punteggio2 = $sfida['punteggio2'];
    
            if ($username == $giocatore1) {
                $queryUpdateStatus = "UPDATE sfide SET status1=true WHERE id = $1";
                $queryUpdateStatusResult = pg_query_params($dbconn, $queryUpdateStatus, array($_GET['id']));
                if($sfida['status2'] == 'true'){
                    $queryUpdateWinner = "UPDATE sfide SET vincitore=$1 WHERE id = $2";
                    if($sfida['punteggio1'] > $sfida['punteggio2']){
                        $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array($giocatore1,$_GET['id']));
                        $esito = "Hai vinto!";
                    }
                    else if($sfida['punteggio1'] < $sfida['punteggio2']){
                        $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array($giocatore2,$_GET['id']));
                        $esito = "Hai perso!";
                    }
                    else{
                        $pareggio = "pareggio";
                        $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array($pareggio,$_GET['id']));
                        $esito = "Hai pareggiato!";
                    }
                    pg_free_result($queryUpdateStatusResult);
                    pg_free_result($queryUpdateWinnerResult);
                }
                else{
                    $esito = "Hai finito il tuo turno! <br> L'altro giocatore deve completare la sfida.";
                }
            } 
            else {
                $queryUpdateStatus = "UPDATE sfide SET status2=true WHERE id = $1";
                $queryUpdateStatusResult = pg_query_params($dbconn, $queryUpdateStatus, array($_GET['id']));
                if($sfida['status1'] == 'true'){
                    $queryUpdateWinner = "UPDATE sfide SET vincitore=$1 WHERE id = $2";
                    if($sfida['punteggio1'] > $sfida['punteggio2']){
                        $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array($giocatore1,$_GET['id']));
                        $esito = "Hai perso!";
                    }
                    else if($sfida['punteggio1'] < $sfida['punteggio2']){
                        $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array($giocatore2,$_GET['id']));
                        $esito = "Hai vinto!";
                    }
                    else{
                        $pareggio = "pareggio";
                        $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array($pareggio,$_GET['id']));
                        $esito = "Hai pareggiato!";
                    }
                    pg_free_result($queryUpdateStatusResult);
                    pg_free_result($queryUpdateWinnerResult);
                }
                else{
                    $esito = "Hai finito il tuo turno! <br> L'altro giocatore deve completare la sfida.";
                }
            }
        }
        
    ?>
    
    <div class="container">
        <div class="esito">
            <?php echo "<h2>$esito</h2>" ?>
        </div>
        <div class="riepilogo">
            <h3>Stato attuale della sfida:<h3>
            </hr>
            <div class="dati">
                <span class='info'>
                   <?php echo $giocatore1; ?>
                </span>
                <span class='info'>
                    <?php echo $punteggio1;?>
                </span>
                <span>-</span>
                <span class='info'>
                    <?php echo $punteggio2; ?>
                </span>
                <span class='info'>
                    <?php echo $giocatore2; ?>
                </span>
            </div>
        </div>
    </div>
</body>
</html>