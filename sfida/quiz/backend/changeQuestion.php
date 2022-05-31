<?php

if (isset($_POST["id"])) {
$dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");

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
                'id' => $domanda['id'],
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
