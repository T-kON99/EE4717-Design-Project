<?php
    include_once '../sqlHandler.php';
    include_once '../../php/config.php';

    function verifyAsDoctor($doctorId, $userId, $type){
        if(is_null($doctorId) || is_null($userId) || is_null($type)){
            echo $doctorId." ".$userId." ".$type;
            return false;
        }
        if($type!='doctor'){
            return false;
        }
        return true;
    }



    session_start();
    $doctorId = isset($_SESSION['doctorId']) ? $_SESSION['doctorId'] : NULL;
    $doctorAccountId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : NULL;

    $slotTimeString = isset($_POST['slotTimeString']) ? $_POST['slotTimeString'] : NULL;

    if(!verifyAsDoctor($doctorId, $doctorAccountId, $type)){
        print($type);
        print($doctorId);
        print($doctorAccountId);
        echo 'Please Log In As Doctor...';
        exit();
    };

    $conn = connect_db();
    if(!checkTimeIsOnSlot($slotTimeString)){
        echo 'Time is not on Slot!';
        errorPostHandling();
    }
    if(checkDoctorBookedByUser($conn, $doctorId, $doctorAccountId, $slotTimeString)){
        deleteAppointment($conn, $doctorId, $doctorAccountId, $slotTimeString);
        echo 'Delete Doctor Own Blocked Time Slot';
        exit();
    }else{
        $queryAns = queryAppointments($conn, $doctorId, $slotTimeString);
        $users_id = 0;
        $queryAns->bind_result($users_id);
        if($queryAns->num_rows > 0){
            while($queryAns->fetch()){
                deleteAppointment($conn, $doctorId, $users_id, $slotTimeString);
                handleCancelAppointmentByDoctor($conn, $users_id, $slotTimeString, $doctorId);
                echo 'Delete Appointment '.$slotTimeString;
            }
            exit();
        }

        if(!checkDoctorWeeklyAvailable($conn, $doctorId, $slotTimeString)){
            echo 'You are not available on this timeslot per week!';
            exit();
        }
        insertAppointment($conn, $doctorId, $doctorAccountId, $slotTimeString);
        echo 'Block Slot '.$slotTimeString;
    }
?>
