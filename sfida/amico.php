<?php 
    if (!isset($_COOKIE['userArray'])) header('Location: ../auth/accesso/');
    
    $data = json_decode($_COOKIE['userArray'], true);
    $avversario = $_POST['username'];
    //echo $avversario;

    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $searchQuery = 'select * from utenti where username!=$1 and username=$2';
    $searchQueryResult = pg_query_params($dbconn, $searchQuery, array($data['username'], $avversario));
    if ($utente = pg_fetch_row($searchQueryResult,null, PGSQL_ASSOC)) {
        echo "utente trovato".':'.$utente['username'];
    }
    else{
        echo "utente non trovato";
    }

    pg_free_result($searchQueryResult);
    pg_close($dbconn);
