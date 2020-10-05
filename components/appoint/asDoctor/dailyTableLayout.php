<?php
// include_once '/../asPatient/appointmentTable.php';
include_once realpath(dirname(__FILE__) . '/../asPatient/appointmentTable.php');
$daySlot = 3;
$workHour = 5;
$startFirstShift = 9;
$startSecondShift = 15;
date_default_timezone_set('Asia/Singapore');
?>
<div style="display:block; text-align:center">
    <fieldset style="width:1500px; display:inline-block;">
        <legend>Manage Appointments & Time Slots
            <?php
            echo '<br>';
            {
                $conn = connect_db();
                $docId = NULL;
                if(isset($_SESSION['doctorId']))
                $docId = $_SESSION['doctorId'];
                $docName = getDoctorNameFromId($conn, $docId);
                if(!is_null($docName))
                echo 'for Dr. '.$docName;
            }
            ?>
        </legend>
        <?php
        createAppointmentTable('asDoctorDailyTableOne', $daySlot, $workHour, $startFirstShift);
        ?>
        <ul class="legend">
            <li><span class="cell_disabled"></span> Not Available</li>
            <li><span class="cell_freeSlot"></span> Available</li>
            <li><span class="cell_bookedSlot"></span> Blocked</li>
            <li><span class="cell_otherBooked"></span> Booked by Patient</li>
        </ul>
    </fieldset>
</div>
<br>

<div style="display:block; text-align:center">
    <h4 style="text-align:center; margin: 0;"> 15.00 - 19.45 </h4>
    <fieldset style="width:1500px; display:inline-block;">
        <legend>Manage Appointments & Time Slots</legend>
        <?php createAppointmentTable('asDoctorDailyTableTwo', $daySlot, $workHour, $startSecondShift);?>
        <ul class="legend">
            <li><span class="cell_disabled"></span> Not Available</li>
            <li><span class="cell_freeSlot"></span> Available</li>
            <li><span class="cell_bookedSlot"></span> Blocked</li>
            <li><span class="cell_otherBooked"></span> Booked by Patient</li>
        </ul>
        <br>
        <br>
        <button id="dailyTableButton" class="custom-button" style="display:inline-block;">
            Submit
        </button>
    </fieldset>
</div>
<script type="module">
    import {setupDailyTableListener, setupDailyTableButton, setupReloadListener} from "../js/appoint/asDoctor/dailyHandler.js"
    setupDailyTableListener('asDoctorDailyTableOne', 3, 5);
    setupDailyTableListener('asDoctorDailyTableTwo', 3, 5);
    setupDailyTableButton('dailyTableButton');
    setupReloadListener();
</script>
