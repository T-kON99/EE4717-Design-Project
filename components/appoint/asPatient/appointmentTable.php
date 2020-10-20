<?php
include_once dirname(__FILE__) . '/../../../serverLogic/sqlHandler.php';
include_once realpath(dirname(__FILE__) . '/../../../php/config.php');

function getSlotPropertiesFromSql($conn, $doctorId, $userId, $slotTimeString){
    /** There are several condition for disabled cells,
     * 1st if the doctor disabled /**
     * 2nd time slot is within 3 hours or less of current time
     * 3rd if it is in the past
     */

    $currentTime = time();

    if(!is_null($userId) && !is_null($doctorId))
        if(checkDoctorBookedByUser($conn, $doctorId, $userId, $slotTimeString))
            return 'cell_bookedSlot';

    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $slotTimeString);
    $slotTime = $datetime->getTimestamp();
    if($slotTime-$currentTime < 60*60*3){
        return 'cell_disabled ';
    }
    //Check if doctor is available this time of the week
    if(!is_null($doctorId)){
        if(!checkDoctorWeeklyAvailable($conn, $doctorId, $slotTimeString)){
            return 'cell_disabled';
        }
        if(!checkDoctorDailyAvailable($conn, $doctorId, $slotTimeString)){
            return 'cell_otherBooked';
        }
    }
    return 'cell_freeSlot';
}

function createAppointmentTable($tableId, $daySlot, $numOfHours, $startTime){
// add doctor, add date

    $conn = connect_db();

    $numOfAppointmentPerHour = 4;
    if(isset($_SESSION['dateChoose'])){
        $time = DateTime::createFromFormat('Y-m-d', $_SESSION['dateChoose']);
        // echo $_SESSION['dateChoose'];
    }else{
        $time = new DateTime();
    }
    // $time = DateTime::createFromFormat('Y-m-d', $startDate);;

    $day = date( "w", $time->getTimestamp());

    print '<table class="hoverTable" id="'.$tableId.'">';
    print '<tr>';
    print '<th></th>';
    for($i = 0; $i < $numOfHours; $i++){
        $hour = $startTime + $i;
        for($j = 0; $j < $numOfAppointmentPerHour; $j++){
            $minute = $j * 15;
            printf ('<th>%d.%02d</th>', $hour, $minute);
        }
    }
    print '</tr>';
    /**
    * Create the table
    */
    $doctorId = NULL;
    $userId = NULL;
    if(isset($_SESSION['doctorId'])) $doctorId = $_SESSION['doctorId'];
    if(isset($_SESSION['id'])) $userId = $_SESSION['id'];

    for ($i = 0; $i < $daySlot; $i++) {
        print '<tr>';
        $newdate=date('D d/m/y', strtotime("+$i days", $time->getTimestamp()));
        print '<td>'.$newdate.'</td>';
        for($j = 0; $j < $numOfHours; $j++){
            $hour = $startTime + $j;
            for($k = 0; $k < $numOfAppointmentPerHour; $k++){
                $minutes = $k*15;
                $dateid = date('Y-m-d ', strtotime("+$i days", $time->getTimestamp()))
                            . sprintf("%02d:%02d:00", $hour, $minutes);
                $class = getSlotPropertiesFromSql($conn, $doctorId, $userId, $dateid);
                print '<td id="'. $dateid.'" class="'.$class.'" data-hour="'.$hour.
                '" data-minutes="'.$minutes.
                '"></td>';
            }
        }
        print '</tr>';
    }
    print '</table>';
}
?>
