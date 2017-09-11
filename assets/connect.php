<?php
    
    // session_start();
    global $db;
    // print_r($_SESSION);

    try {
        $db = new PDO( "mysql:host=localhost;dbname=signup;charset=utf8", "root", "" );
        // var_dump($db);
        $salt = "o78kb6985g6j9hi9=6uj78kh9ikgjoku9kyrj7r";
    }

    catch(Exception $e) {
        echo $e->getMessage() ;
        echo "An error has occurred";
    }

?> 