<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trivia Stack | Classifica</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

  <!-- Style -->
  <link rel="stylesheet" href="../src/css/general.css" />
  <link rel="stylesheet" href="classifica.css" />

</head>

<body>
  <!-- NAVBAR -->
  <div class="barra-nav">
    <div class="barra-nav-logo">
      <a href="../">
        <img src="../src/images/logo.png" alt="Logo Trivia Stack" />
      </a>
    </div>
    <div class="barra-nav-menu">
      <a href="./">Classifica</a>
      <a href="../quiz/">Sfide</a>
      <a href="../contatti/">Contatti</a>
    </div>
    <div class="barra-nav-user">
      <?php
      if (isset($_COOKIE['userArray'])) {
        $data = json_decode($_COOKIE['userArray'], true);
        echo '<a class="button" href="../profilo/"><img src="src/images/icons/profile.svg" alt="Icona Profilo">' . $data['username'] . '</a>';
        echo "<a class='login' href='?logout=true'>Esci</a>";
      } else {
        echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
        echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
      }
      ?>
    </div>
  </div>

  <!-- CLASSIFICA -->
  <div class="descrizione">
    <h2>CLASSIFICA DEI PRIMI 10 GIOCATORI</h2>
  </div><br>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Username</th>
          <th scope="col">Punteggio</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
        $query = 'SELECT nome,cognome,username,punteggio FROM utenti ORDER BY punteggio DESC limit 10';
        $utenti = pg_query($dbconn, $query);
        $posizione = 0;
        while ($utente = pg_fetch_array($utenti, null, PGSQL_ASSOC)) {
          $posizione++;
          $nome = $utente['nome'] . ' ' . $utente['cognome'];
          $username = $utente['username'];
          $punteggio = $utente['punteggio'];
          echo "<tr>";
          echo "<td scope='row'>$posizione</td>";
          echo "<td>$nome</td>";
          echo "<td>$username</td>";
          echo "<td>$punteggio</td>";
        }
        pg_free_result($utenti);
        pg_close($dbconn);
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>