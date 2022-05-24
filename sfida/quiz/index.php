<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trivia Stack | Duello</title>

  <!-- STYLE -->
  <link rel="stylesheet" href="../../src/css/general.css">
  <link rel="stylesheet" href="duello.css">

  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


  <script src="./backend/verifyQuestion.js"></script>
  <script src="./backend/changeQuestion.js"></script>

  <!-- favicon -->
  <link rel="shortcut icon" href="../../src/images/logo.png" />

</head>

<body>

  <?php
  if (!isset($_COOKIE['userArray'])) {
    header("Location: ../../auth/accesso/");
  }

  $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");


  if (isset($_GET['id'])) {
    $sfidaQuery = "SELECT * FROM sfide WHERE id = $1";
    $sfidaResult = pg_query_params($dbconn, $sfidaQuery, array($_GET['id']));
    if ($sfida = pg_fetch_array($sfidaResult, null, PGSQL_ASSOC)) {
      $username = json_decode($_COOKIE["userArray"], true)['username'];
      if ($username != $sfida['giocatore1'] and $username != $sfida['giocatore2']) {
        header("Location: ../");
      } else {
        if (($username == $sfida['giocatore1'] && $sfida['status1'] == 't') || ($username == $sfida['giocatore2'] && $sfida['status2'] == 't')) {
          header("Location: ./risultati/?id=" . $_GET['id']);
        }
        if ($username == $sfida['giocatore1'] && $sfida['status1'] == 'f') {
          $queryUpdateStatus = "UPDATE sfide SET status1=true WHERE id = $1";
          $queryUpdateStatusResult = pg_query_params($dbconn, $queryUpdateStatus, array($_GET['id']));
          pg_free_result($queryUpdateStatusResult);
        } else if ($username == $sfida['giocatore2'] && $sfida['status2'] == 'f') {
          $queryUpdateStatus = "UPDATE sfide SET status2=true WHERE id = $1";
          $queryUpdateStatusResult = pg_query_params($dbconn, $queryUpdateStatus, array($_GET['id']));
          pg_free_result($queryUpdateStatusResult);
        }
      }
    }
    if ($username == $sfida['giocatore1']) {
      $avversario = $sfida['giocatore2'];
    } else {
      $avversario = $sfida['giocatore1'];
    }
    pg_free_result($sfidaResult);
  } else {
    header('Location: ../');
  }

  $countQuery = 'SELECT count(*) from domande';
  $count = pg_fetch_row(pg_query($dbconn, $countQuery))[0];

  $arrayQuestions = [];
  while (count($arrayQuestions) < 5) {
    $random = rand(1, $count);
    if (!in_array($random, $arrayQuestions)) {
      array_push($arrayQuestions, $random);
    }
  }



  $domandaQuery = 'SELECT * from domande where id = $1';
  $domandaQueryResult = pg_query_params($dbconn, $domandaQuery, array($arrayQuestions[0]));

  if ($result = pg_fetch_array($domandaQueryResult, null, PGSQL_ASSOC)) {
    $domanda = $result['domanda'];
    $risposta1 = $result['risposta1'];
    $risposta2 = $result['risposta2'];
    $risposta3 = $result['risposta3'];
    $risposta4 = $result['risposta4'];
    $corretta = $result['corretta'];
  } else {
    echo "c'è stato un errore";
  }

  pg_free_result($domandaQueryResult);
  pg_close($dbconn);
  ?>

  <img id="bg" src="../../src/images/quiz.jpg">


  <div class="container">
    <div class="header">
      <div class="exit" id="exit">&#10006;</div>
      <div class="giocatori">
        <?php
        echo '<span class="left">' . $username . '</span>';
        echo '<span class="center"> - </span>';
        echo '<span class="right">' . $avversario . '</span>';
        ?>
      </div>
      <div class="timer">
        <span class="minuti" id="minuti">5</span>
        <span>:</span>
        <span class="secondi" id="secondi">00</span>
      </div>
    </div>
    <div class="progress-bar" id="progress-bar"></div>
    <div class="quiz" id="quiz">
      <div class="quiz-domanda">
        <?php
        echo "<h2 id='domanda'>$domanda</h2>";
        ?>
      </div>
      <div class="quiz-risposte">
        <div class="quiz-risposta">
          <?php
          echo "<button type='button' class='risposta' id='risposta1' onclick='verifyQuestion($arrayQuestions[0], 1, " . $_GET["id"] . ")'>$risposta1</button>";
          ?>
        </div>
        <div class="quiz-risposta">
          <?php
          echo "<button type='button' class='risposta' id='risposta2' onclick='verifyQuestion($arrayQuestions[0], 2, " . $_GET["id"] . ")'>$risposta2</button>";
          ?>
        </div>
        <div class="quiz-risposta">
          <?php
          echo "<button type='button' class='risposta' id='risposta3' onclick='verifyQuestion($arrayQuestions[0], 3, " . $_GET["id"] . ")'>$risposta3</button>";
          ?>
        </div>
        <div class="quiz-risposta">
          <?php
          echo "<button type='button' class='risposta' id='risposta4' onclick='verifyQuestion($arrayQuestions[0], 4, " . $_GET["id"] . ")'>$risposta4</button>";
          ?>
        </div>
      </div>
      <div class="quiz-prossima">
        <?php
        echo "<button type='button' class='prossima' id='prossima1' onclick='changeQuestion($arrayQuestions[1]," . $_GET['id'] . ", 2)' disabled>Prossima domanda</button>";
        echo "<button type='button' class='prossima' id='prossima2' onclick='changeQuestion($arrayQuestions[2]," . $_GET['id'] . ", 3)'>Prossima domanda</button>";
        echo "<button type='button' class='prossima' id='prossima3' onclick='changeQuestion($arrayQuestions[3]," . $_GET['id'] . ", 4)'>Prossima domanda</button>";
        echo "<button type='button' class='prossima' id='prossima4' onclick='changeQuestion($arrayQuestions[4]," . $_GET['id'] . ", 5)'>Prossima domanda</button>";
        echo "<button type='button' class='prossima' id='prossima5' onclick='changeQuestion(0," . $_GET['id'] . ", 6)'>Vedi i risultati</button>";
        ?>
      </div>
    </div>
  </div>

  <script>
    let elem = document.getElementById('exit');
    elem.addEventListener('click', function() {
      $.post("./backend/finish.php", {
        id: <?php echo $_GET['id']; ?>
      }, function(response) {
        if (response == 1) {
          window.location.href = "../";
        } else {
          console.log(response);
        }
      });
    });
  </script>

  <script>
    var minuti = document.getElementById("minuti");
    var secondi = document.getElementById("secondi");

    var setTimer = setInterval(function() {
      if (parseInt(minuti.innerText) == 0 && parseInt(secondi.innerText) == 0) {
        clearInterval(setTimer);
        alert("Tempo scaduto!");
        window.location.href = "./?id=<?php echo $_GET['id']; ?>";
      } else if (parseInt(secondi.innerText) == 0) {
        secondi.innerText = "59";
        minuti.innerText = parseInt(minuti.innerText) - 1 + "";
      } else {
        secondi.innerText = parseInt(secondi.innerText) - 1 + "";
      }

    }, 1000)
  </script>

</body>

</html>