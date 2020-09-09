<form action="../pages/appoint.php">
   <fieldset style="width:500px">
      <legend>Step 1 Select Specialization</legend>
      <p>
         <label>Select Specialization</label>
         <select id = "specializationList">
            <?php
                $specializations = array("Heart", "Eyes", "Mouth");
                $specsPost = '';
                if ( isset( $_POST['submit'] ) ) {
                    $specsPost = $_REQUEST('specialization');
                }
                for($i=0; $i<sizeof($specializations); $i++){
                    print '<option value="'.$specializations[$i].'" ';
                    print $specializations[$i] == $specsPost ? ' selected="selected">' : ' >'.$specializations[$i].'</option>';
                }
            ?>
        </select>
        <input type="submit" value="Submit">
</p>
</fieldset>
</form>
<fieldset style="width:500px">
   <legend>Step 2 Select Doctor & Time</legend>
   <p>
       <?php include "doctorTable.php" ?>
    <br>
    <br>
    <label>Date</label>
        <input type="date" id="inputDate" >
    <button id="doctorNTimeButton"> Choose </button>
    <script src="../js/selectDoctor.js"></script>
    <script> setupChooseDoctorAndTimeButton("doctorNTimeButton") </script>

</p>
</fieldset>

<!-- <div style="float:right; width=500px; margin-left:500px"> -->
<!-- </div> -->
