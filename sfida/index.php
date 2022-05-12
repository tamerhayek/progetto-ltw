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
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Style -->
    <link rel="stylesheet" href="../src/css/general.css" />
    <link rel="stylesheet" href="sfide.css" />

  </head>
  <body>
    <?php include '../src/php/logout.php';?>
    <!-- NAVBAR -->
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
            echo '<a class="button" href="../profilo/"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">'.$data['username'].'</a>';
            echo "<a class='login' href='?logout=true'><img class='black-icon' src='../src/images/icons/logout.svg'></a>";
          } else {
            echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
            echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
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
        <div class="sfide">
          <?php 
            echo "<h3>Sfide in corso</h3>";
            echo "<h1>Sfida</h1>";
            echo "<h1>Sfida</h1>";
          ?>
        </div>
        <div class="sfide">
          <?php 
            echo "<h3>Sfide concluse</h3>";
            echo "<h1>Sfida</h1>";
            echo "<h1>Sfida</h1>";
          ?>
        </div>
      </div>
  </body>
</html>
