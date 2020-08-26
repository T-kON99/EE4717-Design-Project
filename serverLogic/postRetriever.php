<?php
    include 'sqlHandler.php';

    $doctorSql = $_POST['doctor'];
    $usernameSql = $_POST['username'];
    $dateSql = $_POST['dateTime'];
    // $dateSql = date('Y-m-d H:i:s');

    $conn = connectDatabase();
    $sqlQuery = "INSERT INTO appointmentTable (username, doctor, time)
    VALUES ('". $doctorSql ."','". $usernameSql ."'
        ,'". $dateSql ."')";

    queryDatabase($conn, $sqlQuery);
?>
