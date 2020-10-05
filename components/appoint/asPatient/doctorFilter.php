<h1> Make an Appointment as Patient </h1>
<div style="display:block; text-align:center">
    <?php
    include 'categoryFilter.php';
    ?>
</div>
<div style="display:block; text-align:center">
    <fieldset style="width:500px; display:inline-block;">
        <legend>Step 2 Select Doctor & Time</legend>
        <p>
            <input type="date" id="inputDate" value=
            <?php echo isset($_SESSION['dateChoose']) ? '"'.$_SESSION['dateChoose'].'"' : '""'; ?>
            >
        </p>
        <?php include "doctorTable.php" ?>
        <br>
        <button id="doctorNTimeButton" class="custom-button" style="margin-left:20px;"> Select </button>
        <script type="module">
        import {setupChooseDoctorButton} from "../js/appoint/asPatient/selectDoctor.js"
        console.log('test')
        setupChooseDoctorButton("doctorNTimeButton")
        console.log('test2')
        </script>
    </fieldset>

</div>


<br>

<h4 style="text-align:center; margin: 0;"> 9.00 - 13.45 </h4>


<?php
include_once('appointmentTable.php');
$daySlot = 3;
$workHour = 5;
$startFirstShift = 9;
$startSecondShift = 15;
date_default_timezone_set('Asia/Singapore');
?>
<div style="display:block; text-align:center">
    <fieldset style="width:1200px; display:inline-block;">
        <legend>Step 3 Select Timeslot
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
        createAppointmentTable('firstShiftTable', $daySlot, $workHour, $startFirstShift);
        ?>
    </fieldset>
</div>
<br>

<div style="display:block; text-align:center">
    <h4 style="text-align:center; margin: 0;"> 15.00 - 19.45 </h4>
    <fieldset style="width:1200px; display:inline-block;">
        <legend>Select Timeslot</legend>
        <?php createAppointmentTable('secondShiftTable', $daySlot, $workHour, $startSecondShift);?>
        <br>
        <br>
        <button id="bookingButton" class="custom-button" style="display:inline-block;">
            Sent
        </button>
    </fieldset>
</div>
