<h3>Lista delle domande del gioco</h3>
<div class="table">
<table>
    <tr>
        <th>ID</th>
        <th>Domanda</th>
        <th>Risposta 1</th>
        <th>Risposta 2</th>
        <th>Risposta 3</th>
        <th>Risposta 4</th>
        <th>Risposta Corretta</th>
    </tr>
    <?php
    $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
    $query = 'SELECT * FROM domande order by id';
    $domande = pg_query($dbconn, $query);
    while ($domanda = pg_fetch_array($domande, null, PGSQL_ASSOC)) {
        echo "<tr>";
        foreach ($domanda as $key => $value) {
            echo "\t\t<td>";
            echo "$value";
            echo "</td>";
        }
        echo "</tr>";
    }
    pg_free_result($domande);
    pg_close($dbconn);
    ?>
</table>
</div>