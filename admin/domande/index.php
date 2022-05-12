<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Stack | Admin | Domande</title>

    <!-- STYLE -->
    <link rel="stylesheet" href="../../src/css/general.css">
    <link rel="stylesheet" href="domande.css">
</head>

<body>
    <?php include '../../src/php/logout.php'; ?>
    <?php
        $data = json_decode($_COOKIE['userArray'], true);
        $username = $data['username'];
        $password = $data['password'];
        $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
        $queryUsers = "SELECT username,password,admin FROM utenti where username='" . $username . "' and password='" . $password . "' and admin=true;";
        $utenti = pg_query($dbconn, $queryUsers);
        if (!($utente = pg_fetch_array($utenti, null, PGSQL_ASSOC))) {
            header("location: ../../");
        }
        echo "<div class='admin'><h3>Admin: ".$utente["username"]."</h3>";
        echo "<a class='button' href='../../'>Torna Indietro</a></div>";
        pg_free_result($utenti);
        pg_close($dbconn);
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Domanda</th>
            <th>Risposta 1</th>
            <th>Risposta 2</th>
            <th>Risposta 3</th>
            <th>Risposta 4</th>
            <th>Risposta Corretta</th>
            <th>Azioni</th>
        </tr>
        <?php
        $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
        $query = 'SELECT * FROM domande';
        $domande = pg_query($dbconn, $query);
        while ($domanda = pg_fetch_array($domande, null, PGSQL_ASSOC)) {
            echo "<tr>";
            foreach ($domanda as $key => $value) {
                echo "\t\t<td>";
                echo "$value";
                echo "</td>";
            }
            echo "<td><a href='edit.php?id=" . $domanda['id'] . "'>Modifica</a> <a href='delete.php?id=" . $domanda['id'] . "'>Elimina</a></td>";
            echo "</tr>";
        }
        pg_free_result($domande);
        pg_close($dbconn);
        ?>
    </table>
</body>

</html>