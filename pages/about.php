<?php namespace Main;
    $currentPage = 'About Us';
    $title = 'About Us';
    $fname = 'about';
?>
<?php set_include_path(__DIR__.'/') ?>
<html lang="en">
<head>
    <?php include('../components/head.php'); ?>
</head>
<body>
    <?php include('../components/header.php'); ?>
    <?php include('../components/navbar.php'); ?>
    <div class="root">
        <?php include('../php/info.php'); ?>
        <div class="content">
            An accessible, high performing clinic that responds fast to your daily needs! We've been around since 1989.
        </div>
        <section class="info-banner">
            <div class="banner">
                <div class="container">
                    <div class="main-banner">
                        <div class="banner-item">
                            <div class="box-item">
                                <div class="box-counter"><?php echo $n_patients; ?></div>
                                <div class="box-title">
                                    Patients
                                    <br>
                                    Registered
                                </div>
                            </div>
                        </div>
                        <div class="banner-item">
                            <div class="box-item">
                                <div class="box-counter"><?php echo $n_patients; ?></div>
                                <div class="box-title">
                                    Doctors 
                                    <br>
                                    Registered
                                </div>
                            </div>
                        </div>
                        <div class="banner-item">
                            <div class="box-item">
                                <div class="box-counter"><?php echo $n_patients; ?></div>
                                <div class="box-title">
                                    Patients
                                    <br>
                                    Treated
                                </div>
                            </div>
                        </div>
                        <div class="banner-item">
                            <div class="box-item">
                                <div class="box-counter"><?php echo $n_patients; ?></div>
                                <div class="box-title">Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include('../components/footer.php'); ?>
</body>
</html>