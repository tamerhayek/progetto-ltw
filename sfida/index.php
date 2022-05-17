<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trivia Stack | Sfide</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

  <!-- Style -->
  <link rel="stylesheet" href="../src/css/general.css" />
  <link rel="stylesheet" href="sfide.css" />

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
    <div class="nuova-sfida">
      <div class="casuale">
        <a class="button" href="./casuale.php">Inizia una nuova sfida casuale!</a>
      </div>
      <div class="amico">
        <form name="cercaAmico" action="./amico.php" method='POST'>
          <button type='submit' class="button" id="sfidaamico">Sfida un tuo amico!</button>
          <input type="text" name="username" id="avversario" placeholder="Cerca username">
          <form>
      </div>
    </div>

    <div class="sfide incorso">
      <h3>Sfide in corso</h3>
      <p> Il giocatore con punteggio nullo deve concludere la sfida</p>
      <!-- <table class='table'>
        <tbody> -->
          <?php
          $username = json_decode($_COOKIE["userArray"], true)['username'];

          $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
          $query = 'SELECT * FROM sfide where (giocatore1=$1 or giocatore2=$1) and (status1=false or status2=false)';
          $result = pg_query_params($dbconn, $query, array($username));

          while ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $giocatore1 = $sfida['giocatore1'];
            $giocatore2 = $sfida['giocatore2'];
            $punteggio1 = $sfida['punteggio1'];
            $punteggio2 = $sfida['punteggio2'];
            echo "<a class='sfida' href=''>";
            echo "<div class='sfida-giocatore'>";
            echo "<h3 class='left'>$giocatore1</h3>";
            echo "<h3 class='center'>$punteggio1 - $punteggio2</h3>";
            echo "<h3 class='right'>$giocatore2</h3>";
            echo "</div>";
            echo "</a>";
          }
          ?>
        <!-- </tbody>
      </table> -->
    </div>

    <div class="sfide concluse">
      <table class="table">
        <tbody>
          <?php
          echo "<h3>Sfide concluse</h3>";
          $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
          $query = 'SELECT * FROM sfide where (giocatore1=$1 or giocatore2=$1) and (status1=true and status2=true)';
          $result = pg_query_params($dbconn, $query, array($username));
          while ($sfida = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $giocatore1 = $sfida['giocatore1'];
            $giocatore2 = $sfida['giocatore2'];
            $punteggio1 = $sfida['punteggio1'];
            $punteggio2 = $sfida['punteggio2'];
            echo "<tr>";
            echo "<td scope='row'>$giocatore1</td>";
            echo "<td>$punteggio1</td>";
            echo "<td>-</td>";
            echo "<td>$punteggio2</td>";
            echo "<td>$giocatore2</td>";
          }
          ?>
        </tbody>
      </table>
    </div>
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
</body>

</html>