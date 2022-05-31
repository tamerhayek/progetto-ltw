<?php 
    if (!isset($_COOKIE['userArray'])) header('Location: ../auth/accesso/');
    
    $data = json_decode($_COOKIE['userArray'], true);
    $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
    $countQuery = 'select count(*) from utenti where username != \''.$data['username'].'\'';
    $count = pg_fetch_row(pg_query($dbconn, $countQuery))[0];
    
    $tentativo = 1;
    do {
        $random = rand(0, $count - 1);

        $randomQuery = 'SELECT * from utenti where username != $1 LIMIT 1 OFFSET $2';
        $randomQueryResult = pg_query_params($dbconn, $randomQuery, array($data['username'], $random));
        if ($tuple = pg_fetch_array($randomQueryResult, null, PGSQL_ASSOC)) {
            $avversario = $tuple['username'];
            
            $cercaSfidaQuery = 'select * from sfide where (((giocatore1 = $1 and giocatore2 = $2) or (giocatore1 = $2 and giocatore2 = $1)) and ((status1 = true and status2 = false) or (status1 = false and status2 = true)))';
            
            $cercaSfidaQueryResult = pg_query_params($dbconn, $cercaSfidaQuery, array($data['username'], $avversario));
            if (!($tuple = pg_fetch_array($cercaSfidaQueryResult, null, PGSQL_ASSOC))) { 
                $createQuery = 'INSERT INTO sfide(giocatore1, giocatore2) VALUES ($1, $2)';
                $createQueryResult = pg_query_params($dbconn, $createQuery, array($data['username'], $avversario));
                if ($createQueryResult) {
                    $toSfida = 'select * from sfide where ((giocatore1 = $1 and giocatore2 = $2) or (giocatore1 = $2 and giocatore2 = $1)) and status1 = false and status2 = false';
                    $toSfidaResult = pg_query_params($dbconn, $toSfida, array($data['username'], $avversario));
                    if ($tuple = pg_fetch_array($toSfidaResult, null, PGSQL_ASSOC)) {
                        header('Location: ./quiz/?id='.$tuple['id']);
                    }
                    pg_free_result($toSfidaResult);
                    break;
                } else echo "Errore Creazione";
            } else {
                header('Location: ./?casuale=false');
            }
            pg_free_result($cercaSfidaQueryResult);
        }
        $tentativo += 1;
        pg_free_result($randomQueryResult);
    } while ($tentativo <= 10);
    
    pg_close($dbconn);

?>