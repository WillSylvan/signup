<?php
    
    // session_start();
    global $db;
    // print_r($_SESSION);

    try {
        $db = new PDO( "mysql:host=localhost;dbname=signup;charset=utf8", "root", "" );
        // var_dump($db);
    }

    catch(Exception $e) {
        echo $e->getMessage() ;
        echo "An error has occurred";
    }

?> 