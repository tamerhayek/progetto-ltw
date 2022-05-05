<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Stack | Registrazione Effettuata</title>

    <!-- STYLE -->
    <link rel="stylesheet" href="../../src/css/general.css">
    <link rel="stylesheet" href="registrazione.css">
</head>
<body>
    <div class="registrationSuccess">
        <?php
            if(!isset($_POST["registrazione"])){
                header("Location: ./");
            }
            else{
                $dbconn = pg_connect("host=localhost dbname=trivia-stack port=5432 user=postgres password=password");
                $username = $_POST["username"];
                $query = 'SELECT * from utenti where username = $1'; 
                $result = pg_query_params($dbconn, $query, array($username)); 
                if($tuple = pg_fetch_array($result, null ,PGSQL_ASSOC)){
                    header("Location: ./?utente=false");
                }
                else{
                    $nome = $_POST["nomeUtente"];
                    $cognome = $_POST["cognomeUtente"];
                    $email = $_POST["emailUtente"];
                    $password = md5($_POST["passwordUtente"]);
                    $query2 = 'INSERT into utenti(nome,cognome,email,username,password) values ($1, $2, $3, $4, $5)';
                    $result = pg_query_params($dbconn, $query2, array($nome, $cognome, $email, $username, $password));
                    if($result){   
                        echo "<h2>Benvenuto ".$nome." ".$cognome."</h2></br>";
                        echo "<h3>La registrazione è andata a buon fine!</h3></br>";
                        echo "<h3>Ora ti basta accedere per iniziare una sfida.</h3></br>";
                        echo "<a href=\"../accesso/\">Clicca qui per loggarti!</a>";
                    } else
                        echo ("C'è stato un errore :-(");
                }
            }        
        ?>
    </div>
</body>
</html>
