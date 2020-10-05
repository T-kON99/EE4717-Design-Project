<?php
// include_once '/../asPatient/appointmentTable.php';
// include_once realpath(dirname(__FILE__) . '/weeklyTable.php');
include_once 'weeklyTable.php';
$daySlot = 3;
$workHour = 5;
$startFirstShift = 9;
$startSecondShift = 15;
date_default_timezone_set('Asia/Singapore');
?>
<div style="display:block; text-align:center" onselectstart="return false">
    <fieldset style="width:1500px; display:inline-block;">
        <legend>Manage Weekly Schedule
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
        createWeeklyTable('asDoctorWeeklyTableOne', $workHour, $startFirstShift);
        ?>
        <ul class="legend">
            <li><span class="cell_disabled"></span> Not Available</li>
            <li><span class="cell_freeSlot"></span> Available</li>
        </ul>
    </fieldset>
</div>
<br>

<div style="display:block; text-align:center" onselectstart="return false">
    <h4 style="text-align:center; margin: 0;"> 15.00 - 19.45 </h4>
    <fieldset style="width:1500px; display:inline-block;">
        <legend>Manage Weekly Schedule</legend>
        <?php createWeeklyTable('asDoctorWeeklyTableTwo', $workHour, $startSecondShift);?>
        <ul class="legend">
            <li><span class="cell_disabled"></span> Not Available</li>
            <li><span class="cell_freeSlot"></span> Available</li>
        </ul>
        <br>
        <br>
        <button id="asDoctorWeeklyButton" class="custom-button" style="display:inline-block;">
            Submit
        </button>
    </fieldset>
</div>

<script type="module">
    import {setupWeeklyTableListener, setupWeeklyButtonListener} from "../js/appoint/asDoctor/weeklyHandler.js"
    setupWeeklyTableListener('asDoctorWeeklyTableOne', 5);
    setupWeeklyTableListener('asDoctorWeeklyTableTwo', 5);
    setupWeeklyButtonListener('asDoctorWeeklyButton');
</script>
