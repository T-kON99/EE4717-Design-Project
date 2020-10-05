<?php include('sessionSaving.php'); ?>
<fieldset>
    <legend>Schedule Management</legend>

    <?php
    include('weeklyTableLayout.php');
    ?>
</fieldset>
<br>
<br>
<br>
<br>
<fieldset>
    <legend>Appointment Management</legend>
    <?php
    include('dateFilter.php');
    include('dailyTableLayout.php');
    ?>
</fieldset>
