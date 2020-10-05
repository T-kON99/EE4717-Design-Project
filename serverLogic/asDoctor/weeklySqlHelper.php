<?php
function checkTimeIsOnSlotTimeOnly($time){
    $dt = DateTime::createFromFormat("H:i:s", $time);
    $hoursStr = $dt->format('H'); // '20'
    $hours = (int) $hoursStr;
    $minutesStr = $dt->format('i'); // '20'
    $minutes = (int) $minutesStr;

    if($hours<9 || ($hours >13 && $hours < 15) || $hours > 19){
        return false;
    }
    if($minutes%15!=0){
        return false;
    }
    return true;
};

function checkDoctorWeeklyAvailableTimeOnly($conn, $doctorId, $weekday, $time){
    checkTimeIsOnSlotTimeOnly($time);

    $queryBooked = "SELECT doctors_id, weekday, daytime FROM doctors_availability
    WHERE doctors_id = ? AND weekday = ? AND daytime = ?";

    // prepare and bind
    $prepareAvail = $conn->prepare($queryBooked);
    if($prepareAvail==false){
        print_r($conn->error_list);
        print($conn->error);
    }

    $prepareAvail->bind_param("iis", $doctorId, $weekday, $time);
    $prepareAvail->execute();

    $queryAns = $prepareAvail->get_result();
    if($queryAns->num_rows>0){
        $prepareAvail->close();
        return true;
    }

    $prepareAvail->close();
    return false;
}
function insertDoctorWeeklyAvailable($conn, $doctorId, $weekday, $time){
    checkTimeIsOnSlotTimeOnly($time);

    $queryInsert = "INSERT INTO doctors_availability (doctors_id, weekday, daytime)
    VALUES (?,?,?)";
    // prepare and bind
    $prepareInsert = $conn->prepare($queryInsert);
    $prepareInsert->bind_param("iis", $doctorId, $weekday, $time);
    $prepareInsert->execute();
    $prepareInsert->close();
    echo 'insert '.$weekday.','.$time." success<br>";
}
function deleteDoctorWeeklyAvailable($conn, $doctorId, $weekday, $time){
    checkTimeIsOnSlotTimeOnly($time);

    $queryDelete = "DELETE FROM doctors_availability
        WHERE doctors_id = ? AND weekday = ?
        AND daytime = ?";

    $prepareDelete = $conn->prepare($queryDelete);
    $prepareDelete->bind_param("iis", $doctorId, $weekday, $time);
    $prepareDelete->execute();
    // print($conn->error);
    // print('test');
    $prepareDelete->close();
    echo 'delete '.$weekday.','.$time." success<br>";
}
 ?>
