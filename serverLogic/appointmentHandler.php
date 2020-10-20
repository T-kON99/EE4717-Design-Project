<?php
    include_once 'sqlHandler.php';
    include_once '../php/config.php';

    session_start();

    $doctorId = isset($_SESSION['doctorId']) ? $_SESSION['doctorId'] : NULL;
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
    $slotTimeString = isset($_POST['slotTimeString']) ? $_POST['slotTimeString'] : NULL;
    // $dateSql = date('Y-m-d H:i:s');
    if(is_null($doctorId)){
        echo 'Doctor not chosen...';
        exit();
    }
    if(is_null($userId)){
        echo 'User Not Logged In...';
        exit();
    }
    $conn = connect_db();
    if(!checkTimeIsOnSlot($slotTimeString)){
        echo 'Time is not on Slot!';
        exit();
    }

    if(checkDoctorBookedByUser($conn, $doctorId, $userId, $slotTimeString)){
        deleteAppointment($conn, $doctorId, $userId, $slotTimeString);
        echo 'delete appointment!';
    }else{
        if(!checkDoctorWeeklyAvailable($conn, $doctorId, $slotTimeString)){
            echo 'Doctor is not available on this timeslot!';
            exit();
        }
        if(!checkDoctorDailyAvailable($conn, $doctorId, $slotTimeString)){
            echo 'Doctor not available on this specific timeslot';
            exit();
        }
        insertAppointment($conn, $doctorId, $userId, $slotTimeString);
        echo 'insert appointment!';
    }
?>
