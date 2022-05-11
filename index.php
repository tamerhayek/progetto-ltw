<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trivia Stack</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

  <!-- Style -->
  <link rel="stylesheet" href="src/css/general.css" />
  <link rel="stylesheet" href="index.css" />

</head>

<body>
  <?php include 'src/php/logout.php'; ?>
  <!-- NAVBAR -->
  <div class="barra-nav">
    <div class="barra-nav-logo">
      <a href="">
        <img src="src/images/logo.png" alt="Logo Trivia Stack" />
      </a>
    </div>
    <div class="barra-nav-menu">
      <a href="classifica/">Classifica</a>
      <a href="quiz/">Sfide</a>
      <a href="contatti/">Contatti</a>
    </div>
    <div class="barra-nav-user">
      <?php
      if (isset($_COOKIE['userArray'])) {
        $data = json_decode($_COOKIE['userArray'], true);
        echo '<a class="button" href="/profilo/"><img src="src/images/icons/profile.svg" alt="Icona Profilo">' . $data['username'] . '</a>';
        echo "<a class='login' href='?logout=true'>Esci</a>";
      } else {
        echo "<a class='login' href='auth/accesso/'>Accedi</a>";
        echo "<a class='button' href='auth/registrazione/'>Registrati</a>";
      }
      ?>
    </div>
  </div>

  <!-- HOMEPAGE -->
  <div class="home" id="homepage">
    <div class="home-bg"></div>
    <div class="home-text">
      <h1 class="home-title">Trivia Stack</h1>
      <h3 class="home-subtitle">Computer Science Quiz</h3>
      <a class="button" id="scopri" href="#descrizione">Scopri di più</a>
    </div>
  </div>

  <!-- INFORMAZIONI -->
  <div class="descrizione" id="descrizione">
    <div class="descrizione-img">
      <img src="src/images/question.jpg">
    </div>
    <div class="descrizione-content">
      <p>"Trivia Stack" ha come ispirazione "Trivia Crack",un gioco divertente strutturato a quiz, in cui bisogna sfidare gli altri utenti su domande di cultura generale.
        <br><br>
        La particolarità di "Trivia Stack", così come suggerito dal nome, è che le domande riguardano svariati argomenti di informatica.
        Ciò permette ai giocatori di mettere alla prova le loro conoscenze in questo campo intraprendendo sfide tra di loro nel tentativo di arrivare sempre più in alto nella classifica generale del gioco.
        <br><br>
        Per iniziare a giocare ogni utente deve registrarsi e una volta loggato può iniziare il gioco!
      </p>
      <a href="#chi-siamo" class="button">Chi siamo</a>
    </div>
  </div>

  <!-- TEAM -->
  <div class="team" id="chi-siamo">
    <h2>IL NOSTRO TEAM</h2>
    <div class="sviluppo">
      <div class="dev">
        <img src="src/images/dev/tamer-hayek.jpg">
        <h3>Tamer Hayek</h3>
        <p>Matricola: 1897438</p>
      </div>
      <div class="dev">
        <img src="src/images/dev/tamer-hayek.jpg">
        <h3>Maria Diana Calugaru</h3>
        <p>Matricola: 1893272</p>
      </div>
    </div>
    <h2>COLLABORAZIONI</h2>
    <div class="collaborazioni">
      <div class="sponsor">
        <img src="src/images/dev/tamer-hayek.jpg">
        <h3>Sapienza</h3>
      </div>
      <div class="sponsor">
        <img src="src/images/dev/tamer-hayek.jpg">
        <h3>Mark Zuckerberg</h3>
      </div>
      <div class="sponsor">
        <img src="src/images/dev/tamer-hayek.jpg">
        <h3>Elon Musk</h3>
      </div>
    </div>
    
    <!-- FOOTER -->
    <div class="footer">
      <div class="footer-copyright">
        <p> &copy; Linguaggi e Tecnologie Web 2021/2022</p>
      </div>
      <div class="footer-loghi">
        <a href=""><img alt="Logo Facebook" src="src/images/facebook.png"></a>
        <a href=""><img alt="Logo Instagram" src="src/images/instagram.png"></a>
      </div>
    </div>
</body>

</html>