<?php
include_once dirname(__FILE__) . '/../../../serverLogic/sqlHandler.php';
function getSlotPropertiesFromSql($conn, $doctor, $username, $slotTimeString){
    /** There are several condition for disabled cells,
     * 1st if the doctor disabled /**
     * 2nd time slot is within 3 hours or less of current time
     * 3rd if it is in the past
     */
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

function increaseDateByDays($format, $date, $numOfDays){

    return date( $format, strtotime( "2009-01-31 +1 month" ) ); // PHP:  2009-03-03
}
function createAppointmentTable($tableId, $daySlot, $numOfHours, $startTime){
// add doctor, add date

    $conn = connectDatabase();


    $numOfAppointmentPerHour = 4;
    if(isset($_SESSION['dateChoose'])){
        $time = DateTime::createFromFormat('Y-m-d', $_SESSION['dateChoose']);
        // echo $_SESSION['dateChoose'];
    }else{
        $time = new DateTime();
    }
    // $time = DateTime::createFromFormat('Y-m-d', $startDate);;

    $day = date( "w", $time->getTimestamp());
    // if($day < 3){
    //
    // }
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
    * The idea is that we only have three days slot by start date, and onwards 2 days
    * Saturday and Sunday are skipped
    * Bookeable date is today onwards, no exception
    * That means past date will be cleared in the sql database
    */
    $n = 0;
    for ($i = 0; $i < $daySlot; $i++) {
        if(($day+$n)%7==0) $n+=1;//Sunday Case
        if(($day+$n)%7==6) $n+=2;//Sunday Case
        print '<tr>';
        //newdate needs to change
        $newdate=date('D d/m/y', strtotime("+$n days", $time->getTimestamp()));
        print '<td>'.$newdate.'</td>';
        for($j = 0; $j < $numOfHours; $j++){
            $hour = $startTime + $j;
            for($k = 0; $k < $numOfAppointmentPerHour; $k++){
                $minutes = $k*15;
                $dateid = date('Y-m-d ', strtotime("+$n days", $time->getTimestamp())) . sprintf("%02d:%02d:00", $hour, $minutes);
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
