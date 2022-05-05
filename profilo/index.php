<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        echo "<title>Trivia Stack | "."Profilo"."</title>";
    ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Style -->
    <link rel="stylesheet" href="../src/css/general.css">
    <link rel="stylesheet" href="profilo.css">
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
        <a href="../classifica/">Classifica</a>
        <a href="../quiz/">Sfide</a>
        <a href="../contatti/">Contatti</a>
      </div>
      <div class="navbar-user">
        <?php 
          if (isset($_COOKIE['userArray'])) {
            $data = json_decode($_COOKIE['userArray'], true);
            echo '<a class="button" href="./"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">'.$data['username'].'</a>';
            echo "<a class='login' href='?logout=true'>Esci</a>";
          } else {
            echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
            echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
          }
        ?>
      </div>
    </div>
    
    <!-- PROFILO -->
    <?php 
        $data = json_decode($_COOKIE['userArray'], true);
        $dbconn = pg_connect("host=localhost dbname=trivia-stack port=5432 user=postgres password=password");
        $query = 'SELECT * from utenti where username = $1 and password = $2'; 
        $result = pg_query_params($dbconn, $query, array($data['username'],$data['password'])); 
        if($tuple = pg_fetch_array($result, null,PGSQL_ASSOC)){
            $username = $tuple['username'];
            $nome = $tuple['nome'];
            $cognome = $tuple['cognome'];
            $email = $tuple['email'];
            $password = $tuple['password'];
        }
    ?>
    <div class="container">
        <div class="descrizione">
            <h2>IL TUO PROFILO</h2>
        </div>
        <div class="data">
            <h3>Nome</h3>
            <p><?php echo $nome; ?></p>
            <h3>Cognome</h3>
            <p><?php echo $cognome; ?></p>
            <h3>Email</h3>
            <p><?php echo $email; ?></p>
            <h3>Username</h3>
            <p><?php echo $username; ?></p>
        </div>
    </div>

</body>
</html>