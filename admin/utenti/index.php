<h3>Lista degli utenti del gioco</h3>
<div class="table">
<table>
    <tr>
        <th>Nome</th>
        <th>Cogome</th>
        <th>Email</th>
        <th>Username</th>
        <th>Admin</th>
    </tr>
    <?php
    $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
    $query = 'SELECT nome,cognome,email,username,admin FROM utenti';
    $utenti = pg_query($dbconn, $query);
    while ($utente = pg_fetch_array($utenti, null, PGSQL_ASSOC)) {
        echo "<tr>";
        foreach ($utente as $key => $value) {
            echo "\t\t<td>";
            if ($key == "admin") {
                if ($value == "t") {
                    echo "Si";
                } else {
                    echo "No";
                }
            } else {
                echo $value;
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    pg_free_result($utenti);
    pg_close($dbconn);
    ?>
</table>
</div>