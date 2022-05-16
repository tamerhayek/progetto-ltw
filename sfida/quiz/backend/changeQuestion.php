<?php

if (isset($_POST["id"])) {
$dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");

$queryNextQuestion = "SELECT * FROM domande WHERE id = $1";
$queryNextQuestionResult = pg_query_params($dbconn, $queryNextQuestion, array($_POST['id']));
if ($domanda = pg_fetch_array($queryNextQuestionResult, null, PGSQL_ASSOC)) {

    $querySfida = "SELECT * FROM sfide WHERE id = $1";
    $querySfidaResult = pg_query_params($dbconn, $querySfida, array($_POST['sfida']));
    if ($sfida = pg_fetch_array($querySfidaResult, null, PGSQL_ASSOC)) {
        $username = json_decode($_COOKIE["userArray"], true)['username'];
        if ($username != $sfida['giocatore1'] and $username != $sfida['giocatore2']) {
            echo 0;
        } else {
            $arrayReturn = array(
                'domanda' => $domanda['domanda'],
                'risposta1' => $domanda['risposta1'],
                'risposta2' => $domanda['risposta2'],
                'risposta3' => $domanda['risposta3'],
                'risposta4' => $domanda['risposta4'],
            );
            echo json_encode($arrayReturn);
        }
    }
    pg_free_result($querySfidaResult);
} else {
    echo 0;
}
pg_free_result($queryNextQuestionResult);
pg_close($dbconn);
}
?>
