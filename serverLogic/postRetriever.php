<?php
    include 'sqlHandler.php';

    $doctorSql = $_POST['doctor'];
    $usernameSql = $_POST['username'];
    $slotTimeString = $_POST['slotTimeString'];
    // $dateSql = date('Y-m-d H:i:s');

    $conn = connectDatabase();

    $queryBooked = "SELECT doctor, username, time FROM appointmentTable
        WHERE doctor = ? AND username = ?
        AND time = ?";
    $queryDelete = "DELETE FROM appointmentTable
        WHERE doctor = ? AND username = ?
        AND time = ?";
    $queryInsert = "INSERT INTO appointmentTable (doctor, username, time)
    VALUES (?,?,?)";

    // prepare and bind
    $prepareBooked = $conn->prepare($queryBooked);
    $prepareDelete = $conn->prepare($queryDelete);
    $prepareInsert = $conn->prepare($queryInsert);

    $prepareBooked->bind_param("sss", $doctorSql, $usernameSql, $slotTimeString);
    $prepareDelete->bind_param("sss", $doctorSql, $usernameSql, $slotTimeString);
    $prepareInsert->bind_param("sss", $doctorSql, $usernameSql, $slotTimeString);



    $prepareBooked->execute();
    $queryAns = $prepareBooked->get_result();
    if($queryAns->num_rows){
        $prepareDelete->execute();
    }else{
        $prepareInsert->execute();
    }

    $prepareBooked->close();
    $prepareDelete->close();
    $prepareInsert->close();
?>
