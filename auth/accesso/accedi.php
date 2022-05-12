<?php 
    if (!isset($_POST['accesso'])) {
        header("location: ./");
    }
    $username = $_POST['username'];
    $password = md5($_POST['passwordUtente']);
    $dbconn = pg_connect("postgres://crolxvdhppthgq:76b70cf66246929bd0e20b8c1a277a71fdaf8b317e307801ddcd58314b387a84@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d6fkjg0dv9b5uu");
    $query = "SELECT * FROM utenti WHERE username = $1 AND password = $2";
    $result = pg_query_params($dbconn, $query, array($username, $password));
    if (!($utente = pg_fetch_array($result, null, PGSQL_ASSOC))) {
        header("location: ./?utente=false");
    } else {
        if (!isset($_COOKIE['userArray'])) {
            $data = json_encode(array(
                'username' => $username,
                'password' => $password
            ));
            setcookie("userArray", $data, time() + 2592000, "/");
        }
        header("location: ../../");
    }  
?>