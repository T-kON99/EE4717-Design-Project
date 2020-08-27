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
        echo "Connected successfully";
        return $conn;
    }
}

function queryDatabase($conn, $sqlQuery){
    if ($conn->query($sqlQuery) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlQuery . "<br>" . $conn->error;
    }
}
?>
