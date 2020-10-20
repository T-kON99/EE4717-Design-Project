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

    function handleCancelAppointment($userId, $slotTimeString){
        //TODO Add sent email to notify patient that is cancelled
        echo 'Notify Patient... TODO Add sent email to notify patient that is cancelled';
    }



    session_start();
    $doctorId = isset($_SESSION['doctorId']) ? $_SESSION['doctorId'] : NULL;
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : NULL;

    $slotTimeString = isset($_POST['slotTimeString']) ? $_POST['slotTimeString'] : NULL;

    if(!verifyAsDoctor($doctorId, $userId, $type)){
        print($type);
        print($doctorId);
        print($userId);
        echo 'Please Log In As Doctor...';
        exit();
    };

    $conn = connect_db();
    if(!checkTimeIsOnSlot($slotTimeString)){
        echo 'Time is not on Slot!';
        errorPostHandling();
    }

    if(checkDoctorBookedByUser($conn, $doctorId, $userId, $slotTimeString)){
        deleteAppointment($conn, $doctorId, $userId, $slotTimeString);
        echo 'Delete Doctor Own Blocked Time Slot';
        exit();
    }else{
        $queryAns = queryAppointments($conn, $doctorId, $slotTimeString);
        if($queryAns->num_rows > 0){
            while($row = mysqli_fetch_assoc($queryAns)){
                deleteAppointment($conn, $doctorId, $row['users_id'], $slotTimeString);
                handleCancelAppointment($row['users_id'], $slotTimeString);
                echo 'Delete Appointment '.$slotTimeString;
            }
            exit();
        }

        if(!checkDoctorWeeklyAvailable($conn, $doctorId, $slotTimeString)){
            echo 'You are not available on this timeslot per week!';
            exit();
        }
        insertAppointment($conn, $doctorId, $userId, $slotTimeString);
        echo 'Block Slot '.$slotTimeString;
    }
?>
