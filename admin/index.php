<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Stack | Admin</title>

    <!-- STYLE -->
    <link rel="stylesheet" href="../src/css/general.css">
    <link rel="stylesheet" href="./admin.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="../src/images/logo.png" />
</head>

<body>

    <?php include '../src/php/logout.php'; ?>
    <?php
    if (!isset($_COOKIE['userArray'])) header("Location: ../auth/accesso/");
    ?>
    <!-- NAVBAR -->
    <div class="barra-nav">
        <div class="barra-nav-logo">
            <a href="../">
                <img src="../src/images/logo.png" alt="Logo Trivia Stack" />
            </a>
        </div>
        <div class="barra-nav-menu">
            <a href="../classifica/">Classifica</a>
            <a href="../sfida/">Sfide</a>
            <a href="../contatti/">Contatti</a>
        </div>
        <div class="barra-nav-user">
            <?php
            if (isset($_COOKIE['userArray'])) {
                $data = json_decode($_COOKIE['userArray'], true);
                echo '<a class="button" href="../profilo/"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">' . $data['username'] . '</a>';
                echo "<a class='login' href='?logout=true'><img class='black-icon' src='../src/images/icons/logout.svg'></a>";
            } else {
                echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
                echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
            }
            ?>
        </div>
    </div>


    <?php
    $data = json_decode($_COOKIE['userArray'], true);
    $username = $data['username'];
    $password = $data['password'];
    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $queryUsers = "SELECT username,password,admin FROM utenti where username='" . $username . "' and password='" . $password . "' and admin=true;";
    $utenti = pg_query($dbconn, $queryUsers);
    if (!($utente = pg_fetch_array($utenti, null, PGSQL_ASSOC))) {
        header("location: ../../");
    }
    echo "<div class='admin'><h3>Admin: " . $utente["username"] . "</h3></div>";
    pg_free_result($utenti);
    pg_close($dbconn);
    ?>
    <div class="choose">
        <button class="button" onclick="loadTable('./utenti/index.php')">Utenti</button>
        <button class="button" onclick="loadTable('./domande/index.php')">Domande</button>
        <button class="button" onclick="loadTable('./sfide/index.php')">Sfide</button>
    </div>

    <div id="table"></div>


    <script>
        function loadTable(which) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("table").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", which, true);
            xhttp.send();
        }
    </script>
</body>

</html>