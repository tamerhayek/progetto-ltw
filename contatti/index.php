<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trivia Stack | Contatti</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

  <!-- Style -->
  <link rel="stylesheet" href="../src/css/general.css" />
  <link rel="stylesheet" href="contatti.css" />

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
      <a href="../sfida/">Sfide</a>
      <a href="./">Contatti</a>
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

  <!-- Contenuto -->
  <div class="container">
      <div class="cellulare reveal">
        <img src = '../src/images/celllogo.jpg'>
        <p> +39 1234567890</p>
      </div>
      <div class="email reveal">
        <img src = '../src/images/emaillogo.jpg'>
        <p> triviastack@gmail.com</p>
      </div>
      <div class="indirizzo reveal">
        <img src = '../src/images/posizionelogo.jpg'>
        <p> Viale dello Scalo S. Lorenzo, 82 </br> 00159 </br> Roma RM<p>
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