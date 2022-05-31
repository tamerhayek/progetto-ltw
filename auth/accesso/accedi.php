<?php 
    if (!isset($_POST['accesso'])) {
        header("location: ./");
    }
    $username = $_POST['username'];
    $password = md5($_POST['passwordUtente']);
    $dbconn = pg_connect("host=localhost port=5432 dbname=trivia-stack user=postgres password=password");
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