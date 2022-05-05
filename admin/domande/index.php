<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Stack | Admin | Domande</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Domanda</th>
            <th>Risposta1</th>
            <th>Risposta2</th>
            <th>Risposta3</th>
            <th>Risposta4</th>
            <th>Risposta Corretta</th>
            <th>Azioni</th>
        </tr>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
            $query = 'SELECT * FROM domande';
            $domande = pg_query($dbconn, $query);
            while ($domanda = pg_fetch_array($domande, null, PGSQL_ASSOC)) {
                echo "<tr>";
                foreach ($domanda as $key => $value) {
                    echo "<td>".$domanda['id']."</td>";
                    echo "<td>".$domanda['domanda']."</td>";
                    echo "<td>".$domanda['risposta1']."</td>";
                    echo "<td>".$domanda['risposta2']."</td>";
                    echo "<td>".$domanda['risposta3']."</td>";
                    echo "<td>".$domanda['risposta4']."</td>";
                    echo "<td>".$domanda['risposta_corretta']."</td>";
                    echo "<td><a href='edit.php?id=".$domanda['id']."'>Modifica</a> | <a href='delete.php?id=".$domanda['id']."'>Elimina</a></td>";
                }
                echo "</tr>";
            }
            pg_free_result($domande);
            pg_close($dbconn);
        ?>
    </table>
</body>
</html>