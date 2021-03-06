<?php namespace Main;
    $currentPage = 'Appointments';
    $title = 'Appointments';
    $fname = 'appoint';
?>
<html lang="en">
<head>
    <?php include('../components/head.php'); ?>
</head>
<body>
    <?php set_include_path(__DIR__.'/') ?>
    <?php include('../components/header.php'); ?>
    <?php include('../components/navbar.php'); ?>
    <div class="root">
        <?php
            if(isset($_SESSION['type'])){
                if($_SESSION['type']=='doctor'){
                    include('../components/appoint/asDoctor/asDoctorView.php');
                }else{
                    include('../components/appoint/asPatient/sessionSaving.php');
                    include('../components/appoint/asPatient/doctorFilter.php');
                    echo ('
                    <script type="module">
                        import {setupAsPatient} from "../js/appoint/asPatient/appoint.js"
                        setupAsPatient();
                    </script>
                    ');
                }
            }else{
                include('../components/appoint/asPatient/sessionSaving.php');
                include('../components/appoint/asPatient/doctorFilter.php');
                echo ('
                <script type="module">
                    import {setupAsPatient} from "../js/appoint/asPatient/appoint.js"
                    setupAsPatient();
                </script>
                ');
            }
        ?>
    </div>

    <?php include('../components/footer.php'); ?>
</body>
</html>
