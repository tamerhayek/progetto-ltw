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
      rel="stylesheet"
    />

    <!-- Style -->
    <link rel="stylesheet" href="../src/css/general.css" />
    <link rel="stylesheet" href="classifica.css" />

  </head>
  <body>
    <?php include '../src/php/logout.php';?>
    <!-- NAVBAR -->
    <div class="navbar">
      <div class="navbar-logo">
        <a href="../">
          <img src="../src/images/logo.png" alt="Logo Trivia Stack" />
        </a>
      </div>
      <div class="navbar-menu">
        <a href="./">Classifica</a>
        <a href="../quiz/">Sfide</a>
        <a href="../contatti/">Contatti</a>
      </div>
      <div class="navbar-user">
        <?php 
          if (isset($_COOKIE['userArray'])) {
            $data = json_decode($_COOKIE['userArray'], true);
            echo '<a class="button" href="../profilo/"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">'.$data['username'].'</a>';
            echo "<a class='login' href='?logout=true'>Esci</a>";
          } else {
            echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
            echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
          }
        ?>
      </div>
    </div>
  </body>
</html>
