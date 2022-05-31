<?php 

    if (!isset($_COOKIE['userArray'])) header('Location: ../auth/accesso/');
    
    $data = json_decode($_COOKIE['userArray'], true);
    $avversario = $_POST['username'];

    $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
    $searchUtenteQuery = 'select * from utenti where username!=$1 and username=$2';
    $searchUtenteQueryResult = pg_query_params($dbconn, $searchUtenteQuery, array($data['username'], $avversario));
    if ($utente = pg_fetch_row($searchUtenteQueryResult,null, PGSQL_ASSOC)) {

        $cercaSfidaQuery = 'select * from sfide where ((giocatore1 = $1 and giocatore2 = $2) or (giocatore1 = $2 and giocatore2 = $1)) and (status1 = false or status2 = false)';
        
        $cercaSfidaQueryResult = pg_query_params($dbconn, $cercaSfidaQuery, array($data['username'], $avversario));
        if ($tuple = pg_fetch_array($cercaSfidaQueryResult, null, PGSQL_ASSOC)) {
            header('Location: ./?amico=true');
        }
        else{
            $createQuery = 'INSERT INTO sfide(giocatore1, giocatore2) VALUES ($1, $2)';
            $createQueryResult = pg_query_params($dbconn, $createQuery, array($data['username'], $avversario));
            if ($createQueryResult) {
                $toSfida = 'select * from sfide where ((giocatore1 = $1 and giocatore2 = $2) or (giocatore1 = $2 and giocatore2 = $1)) and status1 = false and status2 = false';
                $toSfidaResult = pg_query_params($dbconn, $toSfida, array($data['username'], $avversario));
                if ($tuple = pg_fetch_array($toSfidaResult, null, PGSQL_ASSOC)) {
                    header('Location: ./quiz/?id='.$tuple['id']);
                }
                pg_free_result($toSfidaResult);
            } else echo "Errore Creazione";
            pg_free_result($createQueryResult);
        }
        pg_free_result($cercaSfidaQueryResult);
    } else{
       header('Location: ./?amico=false');
    }
    pg_free_result($searchUtenteQueryResult);
    pg_close($dbconn);
?>