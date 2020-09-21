<h1> Make an Appointment as Patient </h1>
<div style="display:block; text-align:center">
<form action="../pages/appoint.php" method="post" style="display: inline-block;">
   <fieldset style="width:500px">
      <legend>Step 1 Select Specialization</legend>
      <p>
         <!-- <label>Select Specialization</label> -->
         <select id="specializationList" name="specialization">
            <?php
                $specializations = array("Heart", "Eyes", "Mouth");
                $specsPost = '';
                if ( isset( $_SESSION['specialization'] ) ) {
                    $specsPost = $_SESSION['specialization'];
                }
                for($i=0; $i<sizeof($specializations); $i++){
                    print '<option value="'.$specializations[$i].'" ';
                    print ($specializations[$i] == $specsPost) ? ' selected="selected">' : ' >';
                    print $specializations[$i].'</option>';
                }
            ?>
        </select>
        <br>
        <input type="submit" value="Select" class="custom-button">
</p>
</fieldset>
</form>
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
        <script src="../js/selectDoctor.js"></script>
        <script> setupChooseDoctorAndTimeButton("doctorNTimeButton") </script>
    </fieldset>

</div>


<br>

<h4 style="text-align:center; margin: 0;"> 9.00 - 13.45 </h4>

<div style="display:block; text-align:center">
<fieldset style="width:1200px; display:inline-block;">
   <legend>Step 3 Select Timeslot
       <?php
       if(isset($_SESSION['doctorChoose'])){
           echo '<br>';
           echo 'Dr. '.$_SESSION['doctorChoose'];
       }
       ?>

   </legend>
<?php
include_once('appointmentTable.php');
$daySlot = 3;
$workHour = 5;
$startFirstShift = 9;
$startSecondShift = 15;
date_default_timezone_set('Asia/Singapore');
$today = getdate();
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
</div>
