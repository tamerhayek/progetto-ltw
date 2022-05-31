<?php

    if (!isset($_POST['id'])) {
        echo -1;
    }

    $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
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