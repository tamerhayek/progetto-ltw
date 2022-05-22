<?php

if (isset($_POST["id"]) && isset($_POST["risposta"])) {
    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");

    // trova domanda
    $queryVerify = "SELECT id, corretta FROM domande WHERE id = $1";
    $queryVerifyResult = pg_query_params($dbconn, $queryVerify, array($_POST['id']));
    if ($result = pg_fetch_array($queryVerifyResult, null, PGSQL_ASSOC)) {
        if ($result["corretta"] == $_POST['risposta']) {
            // trova sfida
            $queryScore = "SELECT * FROM sfide WHERE id = $1";
            $queryScoreResult = pg_query_params($dbconn, $queryScore, array($_POST['sfida']));
            if ($sfida = pg_fetch_array($queryScoreResult, null, PGSQL_ASSOC)) {
                // trova giocatore e poi aumenta punteggio di uno
                if ($sfida['giocatore1'] == json_decode($_COOKIE["userArray"], true)['username']) {
                    $queryUpdateScore = "UPDATE sfide SET punteggio1 = punteggio1 + 1 WHERE id = $1";
                    $queryUpdateScoreResult = pg_query_params($dbconn, $queryUpdateScore, array($_POST['sfida']));
                } else {
                    $queryUpdateScore = "UPDATE sfide SET punteggio2 = punteggio2 + 1 WHERE id = $1";
                    $queryUpdateScoreResult = pg_query_params($dbconn, $queryUpdateScore, array($_POST['sfida']));
                }
                pg_free_result($queryUpdateScoreResult);
            }
            pg_free_result($queryScoreResult);
            echo 0;
        } else {
            echo $result["corretta"];
        }
    }
    pg_free_result($queryVerifyResult);
    pg_close($dbconn);
}
?>
