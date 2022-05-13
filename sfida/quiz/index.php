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
</head>

<body>
  <?php
     $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
     $countQuery = 'SELECT count(*) from domande';
     $count = pg_fetch_row(pg_query($dbconn, $countQuery))[0];

     $random = rand(1, $count);

     $domandaQuery = 'SELECT * from domande where id = $1';
     $domandaQueryResult = pg_query_params($dbconn, $domandaQuery, array($random));
     if ($result = pg_fetch_array($domandaQueryResult, null, PGSQL_ASSOC)) {
       $domanda = $result['domanda'];
       $risposta1 = $result['risposta1'];
       $risposta2 = $result['risposta1'];
       $risposta3 = $result['risposta1'];
       $risposta4 = $result['risposta1'];
       $corretta = $result['corretta'];
     }
     else{
       echo "c'è stato un errore";
     }
     
     pg_free_result($domandaQueryResult);
     pg_close($dbconn);
  ?>

  <div class="container">
    <div class="quit">
      <a href="../../">Quit</a>
    </div>
    <div class="quiz">
      <div class="quiz-domanda">
        <?php
          echo "<h2>$domanda</h2>";
        ?>
      </div>
      <div class="quiz-risposte">
        <div class="quiz-risposta">
          <?php
            echo "<button>$risposta1</button>";
          ?>
        </div>
        <div class="quiz-risposta">
          <?php
            echo "<button>$risposta2</button>";
          ?>
        </div>
        <div class="quiz-risposta">
          <?php
            echo "<button>$risposta3</button>";
          ?>
        </div>
        <div class="quiz-risposta">
          <?php
            echo "<button>$risposta4</button>";
          ?>
        </div>
      </div>
    </div>

</body>

</html>