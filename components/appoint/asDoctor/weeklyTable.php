<?php
include_once dirname(__FILE__) . '/../../../serverLogic/asDoctor/weeklySqlHelper.php';
include_once realpath(dirname(__FILE__) . '/../../../php/config.php');


function getSlotWeeklyTable($conn, $doctorId, $slotWeekTime){
    $weekTimeArr = explode( ',', $slotWeekTime, 2);
    $weekdayNum = (int)($weekTimeArr[0]);
    $timeString = $weekTimeArr[1];
    $currentTime = time();

    $conn = connect_db();
    //Check if doctor is available this time of the week
    if(!is_null($doctorId)){
        if(!checkDoctorWeeklyAvailableTimeOnly($conn, $doctorId, $weekdayNum, $timeString)){
            return 'cell_disabled';
        }
    }
    return 'cell_freeSlot';
}

function createWeeklyTable($tableId, $numOfHours, $startTime){
// add doctor, add date

    $conn = connect_db();

    $numOfAppointmentPerHour = 4;
    // $time = DateTime::createFromFormat('Y-m-d', $startDate);;

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

    $weekString = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    for ($i = 0; $i < 7; $i++) {
        print '<tr>';
        print '<td>'.$weekString[$i].'</td>';
        for($j = 0; $j < $numOfHours; $j++){
            $hour = $startTime + $j;
            for($k = 0; $k < $numOfAppointmentPerHour; $k++){
                $minutes = $k*15;
                $timeid = sprintf("%d,%02d:%02d:00", $i+1, $hour, $minutes);
                $class = getSlotWeeklyTable($conn, $doctorId, $timeid);
                // $class = "";
                print '<td id="'. $timeid.'" class="'.$class.'" data-hour="'.$hour.
                '" data-minutes="'.$minutes.
                '"></td>';
            }
        }
        print '</tr>';
    }
    print '</table>';
}
?>
