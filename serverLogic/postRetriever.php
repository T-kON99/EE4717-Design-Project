<?php
    include 'sqlHandler.php';

    $doctorSql = $_POST['doctor'];
    $usernameSql = $_POST['username'];
    $slotTimeString = $_POST['slotTimeString'];
    // $dateSql = date('Y-m-d H:i:s');

    $conn = connectDatabase();
    $queryBooked = "SELECT doctor, username, time FROM appointmentTable
        WHERE doctor = '$doctorSql' AND username = '$usernameSql'
        AND time = '$slotTimeString'";
    $queryDelete = "DELETE FROM appointmentTable
        WHERE doctor = '$doctorSql' AND username = '$usernameSql'
        AND time = '$slotTimeString'";
    $queryInsert = "INSERT INTO appointmentTable (username, doctor, time)
    VALUES ('". $usernameSql ."','". $doctorSql ."'
        ,'". $slotTimeString ."')";

    $queryAns = mysqli_query($conn, $queryBooked);
    if($queryAns->num_rows){
        mysqli_query($conn, $queryDelete);
    }else{
        mysqli_query($conn, $queryInsert);
    }
?>
