<?php include('sessionSaving.php'); ?>

<fieldset>
    <legend><h1> Schedule Management</h1></legend>

    <?php
    include('weeklyTableLayout.php');
    ?>
</fieldset>
<br>
<br>
<br>
<br>
<fieldset>
    <legend><h1>Appointment Management</h1></legend>
    <?php
    include('dateFilter.php');
    include('dailyTableLayout.php');
    ?>
</fieldset>
