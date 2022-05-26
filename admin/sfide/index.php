<h3>Lista delle sfide del gioco</h3>
<div class="table">
<table>
    <tr>
        <th>ID</th>
        <th>Status Giocatore</th>
        <th>Status Sfidante</th>
        <th>Giocatore</th>
        <th>Sfidante</th>
        <th>Vincitore</th>
        <th>Punteggio 1</th>
        <th>Punteggio 2</th>
    </tr>
    <?php
    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $query = 'SELECT * FROM sfide order by id';
    $sfide = pg_query($dbconn, $query);
    while ($sfida = pg_fetch_array($sfide, null, PGSQL_ASSOC)) {
        echo "<tr>";
        foreach ($sfida as $key => $value) {
            echo "\t\t<td>";
            if ($key == "status1" || $key == "status2") {
                if ($value == "f") {
                    echo "Da Giocare";
                } else {
                    echo "Giocato";
                }
            } else {
                echo $value;
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    pg_free_result($sfide);
    pg_close($dbconn);
    ?>
</table>
</div>