<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trivia Stack | Classifica</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap"
    />

    <!-- Style -->
    <link rel="stylesheet" href="../src/css/general.css" />
    <link rel="stylesheet" href="classifica.css" />

  </head>
  <body>
    <!-- CLASSIFICA -->
    <div class="quit">
      <a href="../../">&#8592</a>
    </div>
    <div class="descrizione">
            <h2>CLASSIFICA DEI PRIMI 10 GIOCATORI</h2>
    </div>
    <div class="container">
      <table>
          <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>Punteggio</th>
          </tr>
          <?php
              $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
              $query = 'SELECT nome,cognome,username,punteggio FROM utenti ORDER BY punteggio DESC limit 10';
              $utenti = pg_query($dbconn, $query);
              $posizione=0;
              while ($utente = pg_fetch_array($utenti, null, PGSQL_ASSOC)) {
                  $posizione++;
                  $nome=$utente['nome'].' '.$utente['cognome'];
                  $username=$utente['username'];
                  $punteggio=$utente['punteggio'];
                  echo "<tr><td>$posizione</td><td>$nome</td><td>$username</td><td>$punteggio</td>";
                  /*echo "<tr>";
                  foreach ($utente as $key => $value) {
                      echo "\t\t<td>";
                      echo "$value";
                      echo "</td>";
                  }*/
              }
              pg_free_result($utenti);
              pg_close($dbconn);
          ?>
      </table>
            </div>
  </body>
</html>
