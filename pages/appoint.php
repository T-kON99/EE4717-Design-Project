<?php namespace Main;
    $currentPage = 'Home';
    $title = 'Home';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.php">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/hoverTable.css">
    <link rel="stylesheet" href="../css/<?php echo basename(__FILE__, '.php') . '.css'; ?>">
    <script src="../js/main.js"></script>
    <title><?php echo $title;?></title>
</head>
<body>
    <?php set_include_path(__DIR__.'/') ?>
    <?php include('../components/header.php'); ?>
    <?php include('../components/navbar.php'); ?>
    <div class="root">
        <br></br>
        <h1 style="padding: 0px; margin-bottom: 0px;"> First Shift </h1>
        <h4 style="text-align:center; margin: 0;"> 9.00-13.45 </h4>
        <?php
          include('../components/appointmentTable.php');
          $daySlot = 3;
          $firstShiftSlot = 10 + 1;
          $secondShiftSlot = 10 + 1;
          date_default_timezone_set('Asia/Singapore');
          $today = getdate();
          createAppointmentTable('firstShiftTable', 3, 5, 9);
        ?>
        <h1 style="padding: 0px; margin-bottom: 0px;"> Second Shift </h1>
        <h4 style="text-align:center; margin: 0;"> 15.00-19.45 </h4>
        <?php createAppointmentTable('secondShiftTable', 3, 5, 15);?>
    </div>
    <script type="text/javascript" src="../js/appoint.js"> </script>
    <script>
      setupAppointmentTableListener('firstShiftTable', 3, 5);
      setupAppointmentTableListener('secondShiftTable', 3, 5);
    </script>
    <?php include('../components/footer.php'); ?>
</body>
</html>
