<?php namespace Main;
    $currentPage = 'Appointments';
    $title = 'Appointments';
    $fname = 'appoint';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/favicon.png"/>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.php">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/<?php echo basename(__FILE__, '.php') . '.css'; ?>">
    <script src="../js/main.js"></script>
    <title><?php echo $title;?></title>
</head>
<body>
    <?php set_include_path(__DIR__.'/') ?>
    <?php include('../components/header.php'); ?>
    <?php include('../components/navbar.php'); ?>
    <div class="root">
        <?php
            if(isset($_SESSION['LOGIN_AS_DOCTOR'])){

            }else{
                include('../components/appoint/asPatient/sessionSaving.php');
                include('../components/appoint/asPatient/doctorFilter.php');
                echo ('
                <script type="text/javascript" src="../js/appoint.js"> </script>
                <script>
                    setupAsPatient();
                </script>
                ');
            }
        ?>
    </div>

    <?php include('../components/footer.php'); ?>
</body>
</html>
