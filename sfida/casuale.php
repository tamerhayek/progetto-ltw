<?php 
    if (!isset($_COOKIE['userArray'])) header('Location: ../auth/accesso/');
    
    $data = json_decode($_COOKIE['userArray'], true);
    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $countQuery = 'select count(*) from utenti where username != \''.$data['username'].'\'';
    $count = pg_fetch_row(pg_query($dbconn, $countQuery))[0];

    $random = rand(0, $count - 1);

    $randomQuery = 'SELECT * from utenti where username != $1 LIMIT 1 OFFSET $2';
    $randomQueryResult = pg_query_params($dbconn, $randomQuery, array($data['username'], $random));
    if ($tuple = pg_fetch_array($randomQueryResult, null, PGSQL_ASSOC)) {
        $avversario = $tuple['username'];
        echo $data['username'].' '.$avversario;
        
        $cercaSfidaQuery = 'select * from sfide where ((giocatore1 = $1 and giocatore2 = $2) or (giocatore1 = $2 and giocatore2 = $1)) and (status1 = false or status2 = false)';
        
        $cercaSfidaQueryResult = pg_query_params($dbconn, $cercaSfidaQuery, array($data['username'], $avversario));
        if ($tuple = pg_fetch_array($cercaSfidaQueryResult, null, PGSQL_ASSOC)) {
            header('Location: ./'); // Continua il matchmaking finchè non trova qualcuno
        }

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
    pg_free_result($randomQueryResult);
    pg_free_result($cercaSfidaQueryResult);
    pg_free_result($createQueryResult);
    pg_free_result($toSfidaResult);
    pg_close($dbconn);

?>