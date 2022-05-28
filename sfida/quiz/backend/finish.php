<?php

    if (!isset($_POST['id'])) {
        echo -1;
    }

    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $username = json_decode($_COOKIE["userArray"], true)['username'];

    $querySfida = "SELECT * FROM sfide WHERE id = $1";
    $querySfidaResult = pg_query_params($dbconn, $querySfida, array($_POST['id']));
    if ($sfida = pg_fetch_array($querySfidaResult, null, PGSQL_ASSOC)) {
        $giocatore1 = $sfida['giocatore1'];
        $giocatore2 = $sfida['giocatore2'];
        $punteggio1 = $sfida['punteggio1'];
        $punteggio2 = $sfida['punteggio2'];

        if ($username == $giocatore1) {
            $queryUpdateStatus = "UPDATE sfide SET status1=true WHERE id = $1";
            $queryUpdateStatusResult = pg_query_params($dbconn, $queryUpdateStatus, array($_POST['id']));
            if($sfida['status2'] == 't'){
                $queryUpdateWinner = "UPDATE sfide SET vincitore=$1 WHERE id = $2";
                if($sfida['punteggio1'] > $sfida['punteggio2']){
                    $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array(1, $_POST['id']));
                }
                else if($sfida['punteggio1'] < $sfida['punteggio2']){
                    $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array(2, $_POST['id']));
                }
                else{
                    $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array(0, $_POST['id']));
                }
                pg_free_result($queryUpdateWinnerResult);
            }
            pg_free_result($queryUpdateStatusResult);
            echo 1;
        } 
        else {
            $queryUpdateStatus = "UPDATE sfide SET status2=true WHERE id = $1";
            $queryUpdateStatusResult = pg_query_params($dbconn, $queryUpdateStatus, array($_POST['id']));
            if($sfida['status1'] == 't'){
                $queryUpdateWinner = "UPDATE sfide SET vincitore=$1 WHERE id = $2";
                if($sfida['punteggio1'] > $sfida['punteggio2']){
                    $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array(1, $_POST['id']));
                }
                else if($sfida['punteggio1'] < $sfida['punteggio2']){
                    $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array(2, $_POST['id']));
                }
                else{
                    $queryUpdateWinnerResult = pg_query_params($dbconn, $queryUpdateWinner, array(0, $_POST['id']));
                }
                pg_free_result($queryUpdateWinnerResult);
            }
            pg_free_result($queryUpdateStatusResult);
            echo 1;
        }
    } else {
        echo -1;
    }
    
    
?>