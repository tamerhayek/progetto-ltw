    <?php
        if(!isset($_POST["registrazione"])){
            header("Location: ./");
        }
        else{
            $dbconn = pg_connect("host=localhost dbname=trivia-stack port=5432 user=postgres password=password");
            $username = $_POST["username"];
            $query = 'SELECT * from utenti where username = $1'; 
            $result = pg_query_params($dbconn, $query, array($username)); 
            if($tuple = pg_fetch_array($result, null ,PGSQL_ASSOC)){
                echo "Registrazione non andata a buon fine!<br/>"; 
                echo "Nel nostro sistema è gia presente un account con lo username indicato.<br>";
                echo "Clicca <a href = \"../accesso/\"> qui </a> per loggarti!";
            }
            else{
                $nome = $_POST["nomeUtente"];
                $cognome = $_POST["cognomeUtente"];
                $email = $_POST["emailUtente"];
                $password = md5($_POST["passwordUtente"]);
                $query2 = 'INSERT into utenti(nome,cognome,email,username,password) values ($1, $2, $3, $4, $5)';
                $result = pg_query_params($dbconn, $query2, array($nome, $cognome, $email, $username, $password));
                if($result){   
                    echo "La registrazione è andata a buon fine!<br>";
                    echo "Clicca <a href=\"../accesso/\"> qui </a> per loggarti!";
                }
                else
                    echo ("C'è stato un errore :-(");
            }
        }
    ?>
