<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo "<title>Trivia Stack | Profilo</title>";
    ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet" />

    <!-- Style -->
    <link rel="stylesheet" href="../src/css/general.css">
    <link rel="stylesheet" href="./profilo.css">

    <!-- scrollreveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

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
                echo '<a class="button" href="./"><img src="../src/images/icons/profile.svg" alt="Icona Profilo">' . $data['username'] . '</a>';
                echo "<a class='login' href='?logout=true'><img class='black-icon' src='../src/images/icons/logout.svg'></a>";
            } else {
                echo "<a class='login' href='../auth/accesso/'>Accedi</a>";
                echo "<a class='button' href='../auth/registrazione/'>Registrati</a>";
            }
            ?>
        </div>
    </div>

    <!-- PROFILO -->
    <?php
    $data = json_decode($_COOKIE['userArray'], true);
    $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
    $query = 'SELECT * from utenti where username = $1 and password = $2';
    $result = pg_query_params($dbconn, $query, array($data['username'], $data['password']));
    if ($tuple = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $username = $tuple['username'];
        $nome = $tuple['nome'];
        $cognome = $tuple['cognome'];
        $email = $tuple['email'];
        $admin = $tuple['admin'];
    }
    $vincitoreQuery = 'select count(*) as vinte
                        from sfide
                        where (giocatore1=$1 and vincitore = 1) or (giocatore2=$1 and vincitore = 2)';
    $vincitoreQueryResult = pg_query_params($dbconn, $vincitoreQuery, array($data['username']));
    if ($tuple = pg_fetch_array($vincitoreQueryResult, null, PGSQL_ASSOC)) {
        $partiteVinte = $tuple['vinte'];
    }
    $giocateQuery = 'select count(*) as giocate 
                    from sfide
                    where (giocatore1 = $1 and status1 = true) or (giocatore2 = $1 and status2 = true)';
    $giocateQueryResult = pg_query_params($dbconn, $giocateQuery, array($data['username']));
    if ($tuple = pg_fetch_array($giocateQueryResult, null, PGSQL_ASSOC)) {
        $partiteGiocate = $tuple['giocate'];
    }
    pg_free_result($result);
    pg_close($dbconn);
    ?>
    <div class="container">
        <div class="descrizione">
            <h2>IL TUO PROFILO</h2>
            <?php
            if ($admin == 't') {
                echo "<a class='button' href='../admin/'>Vai alla sezione admin</a>";
            }
            ?>
        </div>
        <br>
        <hr><br>
        <div class="data first" id="nome">
            <h3>NOME</h3>
            <?php echo '<input value="' . $nome . '" disabled>'; ?>
        </div>
        <div class="data" id="cognome">
            <h3>COGNOME</h3>
            <?php echo '<input value="' . $cognome . '" disabled>'; ?>
        </div>
        <div class="data" id="email">
            <h3>EMAIL</h3>
            <?php echo '<input  value="' . $email . '" disabled>'; ?>
        </div>
        <div class="data" id="username">
            <h3>USERNAME</h3>
            <?php echo '<input value="' . $username . '" disabled>'; ?>
        </div>
        <div class="data" id="partiteGiocate">
            <h3>SFIDE GIOCATE</h3>
            <?php echo '<input value="' . $partiteGiocate . '" disabled>'; ?>
        </div>
        <div class="data" id="partiteVinte">
            <h3>SFIDE VINTE</h3>
            <?php echo '<input value="' . $partiteVinte . '" disabled>'; ?>
        </div>
    </div>

    <script>
        ScrollReveal().reveal('.descrizione');
        ScrollReveal().reveal('.data', {
            interval: 100,
            distance: '50px'
        });
    </script>

    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-copyright">
            <p> &copy; Linguaggi e Tecnologie Web 2021/2022</p>
        </div>
        <div class="footer-loghi">
            <a href=""><img alt="Logo Facebook" src="../src/images/facebook.png"></a>
            <a href=""><img alt="Logo Instagram" src="../src/images/instagram.png"></a>
        </div>
    </div>

</body>

</html>