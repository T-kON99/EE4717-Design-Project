<?php
include_once '../serverLogic/sqlHandler.php';
function getSlotPropertiesFromSql($conn, $doctor, $username, $slotTimeString){
    $class = '';
    $currentTime = time();

    //This one for if doctor disable WIP

    $queryBooked = "SELECT doctor, username, time FROM appointmentTable
        WHERE doctor = '$doctor' AND username = '$username'
        AND time = '$slotTimeString'";
    $queryAns = mysqli_query($conn, $queryBooked);
    if($queryAns->num_rows){
        return ' class: cell_bookedSlot ';
    }

    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $slotTimeString);
    $slotTime = $datetime->getTimestamp();

    if($slotTime-$currentTime < 60*60*3){
        return ' class: cell_disabled ';
    }
    $queryBooked = "SELECT doctor, time FROM appointmentTable
        WHERE doctor = '$doctor' AND time = '$slotTimeString'";
    $queryAns = mysqli_query($conn, $queryBooked);
    if($queryAns->num_rows){
        return ' class: cell_otherBooked ';
    }
    return ' class: cell_freeSlot ';
}

function createAppointmentTable($tableId, $daySlot, $numOfHours, $startTime){
// add doctor, add date

    $conn = connectDatabase();

    $numOfAppointmentPerHour = 4;
    $time = getdate();
    $date =date('Y-m-d');

    $day = $time['wday'];
    if($day < 3){

    }
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
    * The idea is that we only have three days slot including current date onwards
    * Saturday and Sunday are skipped
    * And if the days is already late 17.00>, the first date to be bookable is tomorrow instead of today
    */
    if($time['hours']>17) $n = 1;
    else $n = 0;
    for ($i = 0; $i < $daySlot; $i++) {
        if($time['wday']+$n>5) $n+=2;
        print '<tr>';
        $newdate=date('D d/m/y', strtotime("+$n days"));
        print '<td>'.$newdate.'</td>';
        for($j = 0; $j < $numOfHours; $j++){
            $hour = $startTime + $j;
            for($k = 0; $k < $numOfAppointmentPerHour; $k++){
                $minutes = $k*15;
                $dateid = date('Y-m-d ', strtotime("+$n days")) . sprintf("%02d:%02d:00", $hour, $minutes);
                $class = getSlotPropertiesFromSql($conn, 'Edo', 'Jonisins', $dateid);
                print '<td id="'. $dateid.'" class="'.$class.'" data-hour="'.$hour.
                '" data-minutes="'.$minutes.
                '"></td>';
            }
        }
        print '</tr>';
        $n+=1;
    }
    print '</table>';
}
?>
