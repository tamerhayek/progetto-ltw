<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trivia Stack | Sfide</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

  <!-- Style -->
  <link rel="stylesheet" href="../src/css/general.css" />
  <link rel="stylesheet" href="sfide.css" />

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
      <a href="../classifica/">Classifica</a>
      <a href="./">Sfide</a>
      <a href="../contatti/">Contatti</a>
    </div>
    <div class="barra-nav-user">
      <?php
      if (isset($_COOKIE['userArray'])) {
        $data = json_decode($_COOKIE['userArray'], true);
        echo '<a class="button" href="../profilo/"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">' . $data['username'] . '</a>';
        echo "<a class='login' href='?logout=true'><img class='black-icon' src='../src/images/icons/logout.svg'></a>";
      } else {
        header('Location: ../auth/accesso/');
      }
      ?>
    </div>
  </div>

  <!-- Nuove Sfide -->
  <div class="container">
    <div class="nuova-sfida reveal">
      <div class="casuale">
        <a class="button zoom" href="./casuale.php">Inizia una nuova sfida casuale!</a>
        <?php
          if (isset($_GET['casuale'])) {
            if ($_GET['casuale'] == 'false') {
              echo '<p class="error">La ricerca ha impiegato troppo tempo! <br> Cerca le sfide in attesa e in corso.</p>';
            }
          }
          ?>
      </div>
      <form name="cercaAmico" class="amico" action="./amico.php" method='POST'>
        <button type='submit' class="button zoom" id="sfidaamico">Sfida un tuo amico!</button>
        <div class="search-input">
          <input class="zoom" type="text" name="username" placeholder="Cerca username">
          <?php
          if (isset($_GET['amico'])) {
            if ($_GET['amico'] == 'false') {
              echo '<p class="error">Utente non trovato!</p>';
            }
            else if ($_GET['amico'] == 'true') {
              echo '<p class="error">Sfida già esistente!</p>';
            }
          }
          ?>
        </div>

      </form>
    </div>

    <!-- LISTA DELLE SFIDE IN CORSO -->
    <?php
      $username = json_decode($_COOKIE["userArray"], true)['username'];

      $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
      $query = 'SELECT * FROM sfide where (giocatore1=$1 and status1=false) or (giocatore2=$1 and status2=false)';
      $result = pg_query_params($dbconn, $query, array($username));
      
      if ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)){
        echo '<div class="sfide incorso reveal">';
        echo '<h3>Sfide in corso</h3>';
        echo '<p> È il tuo turno!</p>';
        $result = pg_query_params($dbconn, $query, array($username));
        while ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          $id = $sfida['id'];
          $giocatore1 = $sfida['giocatore1'];
          $giocatore2 = $sfida['giocatore2'];
          $punteggio1 = $sfida['punteggio1'];
          $punteggio2 = $sfida['punteggio2'];
          echo "<a class='sfida' href='./quiz/risultati/?id=$id'>";
          echo "<div class='sfida-giocatore'>";
          echo "<span class='left'>$giocatore1</span>";
          echo "<span class='center'>$punteggio1 - $punteggio2</span>";
          echo "<span class='right'>$giocatore2</span>";
          echo "</div>";
          echo "</a>";
        }
        echo '</div>';
      }
      pg_free_result($result);
    ?>

    <!-- LISTA DELLE SFIDE IN ATTESA -->
    <?php
      $query = 'SELECT * FROM sfide where (giocatore1=$1 and status1=true and status2=false) or (giocatore2=$1 and status2=true and status1=false)';
      $result = pg_query_params($dbconn, $query, array($username));

      if ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)){
        echo '<div class="sfide inattesa reveal">';
        echo '<h3>Sfide in attesa</h3>';
        echo "<p>L'avversario deve ancora giocare!</p>";
        $result = pg_query_params($dbconn, $query, array($username));
        while ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          $id = $sfida['id'];
          $giocatore1 = $sfida['giocatore1'];
          $giocatore2 = $sfida['giocatore2'];
          $punteggio1 = $sfida['punteggio1'];
          $punteggio2 = $sfida['punteggio2'];
          echo "<a class='sfida' href='./quiz/risultati/?id=$id'>";
          echo "<div class='sfida-giocatore'>";
          echo "<span class='left'>$giocatore1</span>";
          echo "<span class='center'>$punteggio1 - $punteggio2</span>";
          echo "<span class='right'>$giocatore2</span>";
          echo "</div>";
          echo "</a>";
        }
        echo '</div>';
      }
      pg_free_result($result);
    ?>

    <!-- LISTA DELLE SFIDE CONCLUSE -->
    <?php
      $query = 'SELECT * FROM sfide where (giocatore1=$1 or giocatore2=$1) and (status1=true and status2=true)';
      $result = pg_query_params($dbconn, $query, array($username));

      if($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)){
        echo '<div class="sfide concluse reveal">';
        echo "<h3>Sfide concluse</h3>";
        $result = pg_query_params($dbconn, $query, array($username));
        while ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          $id = $sfida['id'];
          $giocatore1 = $sfida['giocatore1'];
          $giocatore2 = $sfida['giocatore2'];
          $punteggio1 = $sfida['punteggio1'];
          $punteggio2 = $sfida['punteggio2'];
          $vincitore = $sfida['vincitore'];
          echo "<a class='sfida' href='./quiz/risultati/?id=$id'>";
          if (($vincitore == 1 && $giocatore1 == $username) || ($vincitore == 2 && $giocatore2 == $username)) {
            echo "<div class='sfida-giocatore vittoria'>";
          }
          else if (($vincitore == 1 && $giocatore2 == $username) || ($vincitore == 2 && $giocatore1 == $username)) {
            echo "<div class='sfida-giocatore sconfitta'>";
          } else {
            echo "<div class='sfida-giocatore'>";
          }
          echo "<span class='left'>$giocatore1</span>";
          echo "<span class='center'>$punteggio1 - $punteggio2</span>";
          echo "<span class='right'>$giocatore2</span>";
          echo "</div>";
          echo "</a>";
        }
        echo '</div>';
      }
      pg_free_result($result);
      pg_close($dbconn);
    ?>
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

  <script>
    ScrollReveal().reveal('.reveal', {
      distance: '50px',
      duration: 1000,
      easing: 'cubic-bezier(.215,.61,.355, 1)',
      interval: 100
    });
    ScrollReveal().reveal('.zoom', {
      duration: 1000,
      easing: 'cubic-bezier(.215,.61,.355, 1)',
      interval: 200,
      scale: 0.65,
      mobile: false
    });
  </script>

</body>

</html>