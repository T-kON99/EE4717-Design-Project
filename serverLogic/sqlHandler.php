<?php
// 1. time is on the slot,
// 2. Doctor is available, means doctor is not booked by himself or other people
// 3. Doctor weekly is available
function checkTimeIsOnSlot($slotTimeString){
    $dt = DateTime::createFromFormat("Y-m-d H:i:s", $slotTimeString);
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
}

function checkDoctorBookedByUser($conn, $doctorId, $userId, $slotTimeString){
    $queryBooked = "SELECT doctors_id, users_id, timeslot FROM appointments
        WHERE doctors_id = ? AND users_id = ?
        AND timeslot = ?";

    // prepare and bind
    $prepareBooked = $conn->prepare($queryBooked);

    if($prepareBooked==false){
        print_r($conn->error_list);
        print($conn->error);
    }

    $prepareBooked->bind_param("iis", $doctorId, $userId, $slotTimeString);

    $prepareBooked->execute();

    $prepareBooked->store_result();
    if($prepareBooked->num_rows){
        $prepareBooked->close();
        return true;
    }else{
        $prepareBooked->close();
        return false;
    }

}

function checkDoctorDailyAvailable($conn, $doctorId, $slotTimeString){
    //Get Doctor id and User id
    $queryBooked = "SELECT doctors_id, timeslot FROM appointments
        WHERE doctors_id = ? AND timeslot = ?";

    // prepare and bind
    $prepareBooked = $conn->prepare($queryBooked);

    $prepareBooked->bind_param("is", $doctorId, $slotTimeString);
    $prepareBooked->execute();

    $prepareBooked->store_result();
    if($prepareBooked->num_rows){
        $prepareBooked->close();
        return false;
    }

    $prepareBooked->close();
    return true;
}

function checkDoctorWeeklyAvailable($conn, $doctorId, $slotTimeString){
    checkTimeIsOnSlot($slotTimeString);
    $dt = DateTime::createFromFormat("Y-m-d H:i:s", $slotTimeString);
    $weekday = $dt->format('N');
    $time = $dt->format('H:i:s');
    // $dt->format('N')

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

    $prepareAvail->store_result();
    if($prepareAvail->num_rows){
        $prepareAvail->close();
        return true;
    }

    $prepareAvail->close();
    return false;
}

function insertAppointment($conn, $doctorId, $userId, $slotTimeString){
    $queryInsert = "INSERT INTO appointments (doctors_id, users_id, timeslot)
    VALUES (?,?,?)";
    // prepare and bind
    $prepareInsert = $conn->prepare($queryInsert);
    $prepareInsert->bind_param("iis", $doctorId, $userId, $slotTimeString);
    $prepareInsert->execute();
    $prepareInsert->close();
}

function deleteAppointment($conn, $doctorId, $userId, $slotTimeString){
    $queryDelete = "DELETE FROM appointments
        WHERE doctors_id = ? AND users_id = ?
        AND timeslot = ?";

    $prepareDelete = $conn->prepare($queryDelete);
    $prepareDelete->bind_param("iis", $doctorId, $userId, $slotTimeString);
    $prepareDelete->execute();
    $prepareDelete->close();
}

function queryFilterDoctor($conn, $category_id, $orderBy){
    $queryDoctor = "SELECT doctors.id AS doctor_id,
        doctors.name AS doctor_name,
        categories.name AS category_name,
        doctors.address,
        doctors.rating
     FROM doctors INNER JOIN categories
    ON doctors.category_id=categories.id ";
    if(!is_null($category_id)){
        if($category_id!=-1)
            $queryDoctor = $queryDoctor. " WHERE doctors.category_id = ?";
    }

    if(!is_null($orderBy)){
        if($orderBy=="rating")
            $queryDoctor = $queryDoctor." ORDER BY doctors.rating DESC";
        else if($orderBy=="doctorAsc")
            $queryDoctor = $queryDoctor." ORDER BY doctors.name ASC";
        else if($orderBy=="doctorDesc")
            $queryDoctor = $queryDoctor." ORDER BY doctors.name DESC";
    }

    $prepareDoctorTable = $conn->prepare($queryDoctor);

    if(!is_null($category_id)){
        echo 'category_id'.$category_id;
        if($category_id!=-1){
            $prepareDoctorTable->bind_param("i", $category_id);
            $prepareDoctorTable->execute();
        }else $prepareDoctorTable->execute();
    }else{
      $prepareDoctorTable->execute();
    }
    $prepareDoctorTable->store_result();

    return $prepareDoctorTable;
}

function getDoctorNameFromId($conn, $doctorId){
    if(is_null($doctorId))
        return NULL;
    $queryDoctor = "SELECT name FROM doctors WHERE id = ?";

    $prepareDoctorTable = $conn->prepare($queryDoctor);

    $prepareDoctorTable->bind_param("i", $doctorId);
    $prepareDoctorTable->execute();

    $prepareDoctorTable->store_result();

    if($prepareDoctorTable->num_rows>0){
        $name = "";
        $prepareDoctorTable->bind_result($name);
        $prepareDoctorTable->fetch();
        $prepareDoctorTable->close();
        return $name;
    }
    return NULL;
}

function queryCategories($conn){
    $queryCategory = "SELECT id, name FROM categories";

    $prepareCategories = $conn->prepare($queryCategory);
    $prepareCategories->execute();

    $prepareCategories->store_result();
    return $prepareCategories;
}

function queryAppointments($conn, $doctorId, $slotTimeString){
    $queryAppointments = "SELECT users_id FROM appointments
        WHERE doctors_id = ? AND timeslot = ?";

    $prepareAppointments = $conn->prepare($queryAppointments);
    $prepareAppointments->bind_param("is", $doctorId, $slotTimeString);

    $prepareAppointments->execute();

    $prepareAppointments->store_result();


    return $prepareAppointments;
}

function getDoctorIdFromUserId($conn, $userId){
    if(is_null($userId))
        return NULL;

    $queryDoctor = "SELECT id FROM doctors WHERE user_id = ?";

    $prepareDoctorTable = $conn->prepare($queryDoctor);

    $prepareDoctorTable->bind_param("i", $userId);
    $prepareDoctorTable->execute();

    $prepareDoctorTable->store_result();

    if($prepareDoctorTable->num_rows){
        $id = 0;
        $prepareDoctorTable->bind_result($id);
        $prepareDoctorTable->fetch();
        return $id;
    }
    return NULL;
}

function getUserEmailFromId($conn, $userId){
    if(is_null($userId))
        return NULL;

    $query = "SELECT email FROM users WHERE id = ?";

    $prepareTable = $conn->prepare($query);

    $prepareTable->bind_param("i", $userId);
    $prepareTable->execute();

    $prepareTable->store_result();

    if($prepareTable->num_rows){
        $email = "";
        $prepareTable->bind_result($email);
        $prepareTable->fetch();
        $prepareTable->close();
        return $email;
    }
    return NULL;
}

function getDoctorEmailFromDoctorId($conn, $doctorId){
  if(is_null($doctorId))
      return NULL;
  $queryDoctor =
  "SELECT users.email AS email
   FROM doctors INNER JOIN users ON doctors.user_id=users.id
   WHERE doctors.id = ?";

  $prepareDoctorTable = $conn->prepare($queryDoctor);

  $prepareDoctorTable->bind_param("i", $doctorId);
  $prepareDoctorTable->execute();

  $prepareDoctorTable->store_result();

  if($prepareDoctorTable->num_rows>0){
      $email = "";
      $prepareDoctorTable->bind_result($email);
      $prepareDoctorTable->fetch();
      $prepareDoctorTable->close();
      return $email;
  }
  return NULL;
}

function handleCancelAppointmentByDoctor($conn, $userId, $slotTimeString, $doctorId){
    $email = getUserEmailFromId($conn, $userId);
    $doctorEmail = getDoctorEmailFromDoctorId($conn, $doctorId);
    $doctorName = getDoctorNameFromId($conn, $doctorId);

    $msg = "Greetings user, your appointment with Dr. ".$doctorName." on ".$slotTimeString." is cancelled by Dr. ".$doctorName;
    $msg = wordwrap($msg,70);
    mail($email,"Appointment Cancellation by Doctor",$msg);

    $msg = "Hi Dr. ".$doctorName.", you have cancelled your appointment on ".$slotTimeString;
    $msg = wordwrap($msg,70);
    mail($doctorEmail,"Appointment Cancellation by Doctor",$msg);
}

function handleBookAppointment($conn, $userId, $slotTimeString, $doctorId){
    $email = getUserEmailFromId($conn, $userId);
    $doctorEmail = getDoctorEmailFromDoctorId($conn, $doctorId);
    $doctorName = getDoctorNameFromId($conn, $doctorId);

    // send email to user
    $msg = "Greetings user, you have booked an appointment with Dr. ".$doctorName." on ".$slotTimeString;
    $msg = wordwrap($msg,70);
    mail($email,"Appointment Booking",$msg);

    $msg = "Hi Dr. ".$doctorName.", there is a new appointment on ".$slotTimeString;
    $msg = wordwrap($msg,70);
    mail($doctorEmail,"Appointment Booked by Patient",$msg);
}

function handleCancelAppointment($conn, $userId, $slotTimeString, $doctorId){
    $email = getUserEmailFromId($conn, $userId);
    $doctorEmail = getDoctorEmailFromDoctorId($conn, $doctorId);
    $doctorName = getDoctorNameFromId($conn, $doctorId);

    $msg = "Greetings user, you have cancelled the appointment with Dr. ".$doctorName." on ".$slotTimeString;
    $msg = wordwrap($msg,70);
    mail($userEmail,"Appointment Cancellation",$msg);

    $msg = "Hi Dr. ".$doctorName.", your appointment on ".$slotTimeString." is cancelled";
    $msg = wordwrap($msg,70);
    mail($doctorEmail,"Appointment Cancellation by Patient",$msg);
}
?>
