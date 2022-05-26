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
    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
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