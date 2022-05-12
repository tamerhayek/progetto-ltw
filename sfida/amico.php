<?php 
    if (!isset($_COOKIE['userArray'])) header('Location: ../auth/accesso/');
    
    $data = json_decode($_COOKIE['userArray'], true);
    $avversario = $_POST['username'];

    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $searchUtenteQuery = 'select * from utenti where username!=$1 and username=$2';
    $searchUtenteQueryResult = pg_query_params($dbconn, $searchUtenteQuery, array($data['username'], $avversario));
    if ($utente = pg_fetch_row($searchUtenteQueryResult,null, PGSQL_ASSOC)) {
        echo "utente trovato".':'.$utente['username'];

        $cercaSfidaQuery = 'select * from sfide where ((giocatore1 = $1 and giocatore2 = $2) or (giocatore1 = $2 and giocatore2 = $1)) and (status1 = false or status2 = false)';
        
        $cercaSfidaQueryResult = pg_query_params($dbconn, $cercaSfidaQuery, array($data['username'], $avversario));
        if ($tuple = pg_fetch_array($cercaSfidaQueryResult, null, PGSQL_ASSOC)) {
            echo "<p>c'è già una sfida in corso con questo utente<p>";
            header('Location: ./');
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
            } else echo "Errore Creazione";
        }
    }
    else{
        echo "utente non trovato";
    }
    /*pg_free_result($searchUtenteQueryResult);
    pg_free_result($cercaSfidaQueryResult);
    pg_free_result($createQueryResult);
    pg_free_result($toSfidaResult);*/
    pg_close($dbconn);
?>