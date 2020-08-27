<?php
function connectDatabase(){
    $servername = "localhost";
    $username = "database_user";
    $password = "user_password";
    $database_name = "database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database_name);
    if (!$conn) {
        echo 'Connection failed: ' . $conn->connect_error;
    }else{
        return $conn;
    }
}
?>
