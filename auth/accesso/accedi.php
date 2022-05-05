<?php 
    if (!isset($_COOKIE['userArray'])) {
        $data = json_encode(array(
            'username' => 'tamerhayek',
            'password' => 'password'
        ));
        setcookie("userArray", $data, time() + 2592000, "/");
    }
    header("location: ../../");
?>