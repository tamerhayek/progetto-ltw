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

  <!-- scrollreveal -->
  <script src="https://unpkg.com/scrollreveal"></script>

  <!-- favicon -->
  <link rel="shortcut icon" href="../src/images/logo.png" />

</head>

<body>
  <?php include '../src/php/logout.php'; ?>

  <!-- NAVBAR -->
  <div class="barra-nav">
    <div class="barra-nav-logo">
      <a href="../">
        <img src="../src/images/logo.png" alt="Logo Trivia Stack" />
      </a>
    </div>
    <div class="barra-nav-menu">
      <a href="./">Classifica</a>
      <a href="../sfida/">Sfide</a>
      <a href="../contatti/">Contatti</a>
    </div>
    <div class="barra-nav-user">
      <?php
      if (isset($_COOKIE['userArray'])) {
        $data = json_decode($_COOKIE['userArray'], true);
        echo '<a class="button" href="../profilo/"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">' . $data['username'] . '</a>';
        echo "<a class='login' href='?logout=true'><img class='black-icon' src='../src/images/icons/logout.svg'></a>";
      } else {
        echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
        echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
      }
      ?>
    </div>
  </div>

  <!-- CLASSIFICA -->
  <div class="descrizione reveal">
    <h2>I MIGLIORI GIOCATORI</h2>
  </div><br>
  <div class="container">
    <table class="table">
      <thead>
        <tr class="reveal">
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Username</th>
          <th scope="col">Punteggio</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
        $query = 'select u.nome, u.cognome, u.username, s.vinte punteggio
                  from utenti u join (
                      select u2.username as giocatore, count(*) as vinte
                      from sfide s join utenti u2 on (s.giocatore1 = u2.username or s.giocatore2 = u2.username)
                      where (giocatore1=u2.username and vincitore = 1) or (giocatore2=u2.username and vincitore = 2)
                      group by u2.username
                      ) s on (u.username = s.giocatore)
                  order by s.vinte desc
                  limit 10';
        $utenti = pg_query($dbconn, $query);
        $posizione = 0;
        while ($utente = pg_fetch_array($utenti, null, PGSQL_ASSOC)) {
          $posizione++;
          $nome = $utente['nome'] . ' ' . $utente['cognome'];
          $username = $utente['username'];
          $punteggio = $utente['punteggio'];
          echo "<tr class='reveal'>";
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

  <!-- FOOTER -->
  <div class="footer">
    <div class="footer-copyright">
      <p> &copy; Linguaggi e Tecnologie Web 2021/2022</p>
    </div>
    <div class="footer-loghi">
      <a href=""><img alt="Logo Facebook" src="../src/images/facebook.png"></a>
      <a href=""><img alt="Logo Instagram" src="../src/images/instagram.png"></a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
     ScrollReveal().reveal('.reveal', {
        distance: '50px',
        duration: 1000,
        easing: 'cubic-bezier(.215,.61,.355, 1)',
        interval: 100
      });
  </script>
</body>
</html>