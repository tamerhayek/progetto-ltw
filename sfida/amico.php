<?php 
    if (!isset($_COOKIE['userArray'])) header('Location: ../auth/accesso/');
    
    $data = json_decode($_COOKIE['userArray'], true);
    $avversario = $_POST['username'];
    //echo $avversario;

    $dbconn = pg_connect("host=localhost dbname=trivia-stack port=5432 user=postgres password=password");
    $searchQuery = 'select * from utenti where username!=$1 and username=$2';
    $searchQueryResult = pg_query_params($dbconn, $searchQuery, array($data['username'], $avversario));
    if ($utente = pg_fetch_row($searchQueryResult,null, PGSQL_ASSOC)) {
        echo "utente trovato".':'.$utente['username'];
    }
    else{
        echo "utente non trovato";
    }

?>