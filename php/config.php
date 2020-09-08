<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'ee4717');
    ini_set('session.cookie_httponly', '1');
    
    function connectDB($server = DB_SERVER, $username = DB_USERNAME, $password = DB_PASSWORD, $dbname = DB_NAME) {
        $db_connection = mysqli_connect($server, $username, $password, $dbname);
        // Check connection
        if(!$db_connection){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $db_connection;
    }
?>