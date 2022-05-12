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
        if (!isset($_POST["registrazione"])) {
            header("Location: ./");
        } else {
            $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
            $username = $_POST["username"];
            $query = 'SELECT * from utenti where username = $1';
            $result = pg_query_params($dbconn, $query, array($username));
            if ($tuple = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                header("Location: ./?utente=false");
            } else {
                $nome = $_POST["nomeUtente"];
                $cognome = $_POST["cognomeUtente"];
                $email = $_POST["emailUtente"];
                $password = md5($_POST["passwordUtente"]);
                pg_free_result($result);
                $query2 = 'INSERT into utenti(nome,cognome,email,username,password) values ($1, $2, $3, $4, $5)';
                $result = pg_query_params($dbconn, $query2, array($nome, $cognome, $email, $username, $password));
                if ($result) {
                    echo "<h2>Benvenuto " . $nome . " " . $cognome . "</h2></br>";
                    echo "<h3>La registrazione è andata a buon fine!</h3></br>";
                    echo "<h3>Ora ti basta accedere per iniziare una sfida.</h3></br>";
                    echo "<a href=\"../accesso/\">Clicca qui per loggarti!</a>";
                } else
                    echo ("C'è stato un errore :-(");
            }
        }
        pg_free_result($result);
        pg_close($dbconn);
        ?>
    </div>
</body>

</html>