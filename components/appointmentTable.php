<?php
  function createAppointmentTable($tableId, int $daySlot, int $numOfHours, int $startTime){
    $weekDayString = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");

    $numOfAppointmentPerHour = 4;
    $time = getdate();
    $shiftSlot = $numOfHours * $numOfAppointmentPerHour;
    $diff24Hours = new DateInterval('PT24H');
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


    if($time['hours']>17) $n = 1;
    else $n = 0;
    for ($i = 0; $i < $daySlot; $i++) {
      $n+=1;
      if($time['wday']+$n>5) $n+=2;
      print '<tr>';
      $newdate=date('D d/m/y', strtotime("+$n days"));
      $weekDay = $weekDayString[$i+1];
      print '<td>'.$newdate.'</td>';
      for($j = 0; $j < $numOfHours; $j++){
        $hour = $startTime + $j;
        for($k = 0; $k < $numOfAppointmentPerHour; $k++){
          $minutes = $k*15;
          print '<td data-hour="'.$hour
          .'" data-minutes="'.$minutes.
          '"></td>';
        }
      }
      print '</tr>';
    }
    print '</table>';
  }
?>
