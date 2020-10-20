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
        <div class="content">
            <div class="content-wrapper-image">
                <img src="../images/about-banner.jpg" alt="about-banner">
            </div>
            <div class="content-wrapper">
                <div class="content-title">
                    <h2>Lorem ipsum <span class="text-teal">dolor sit</span> amet</h2>
                </div>
                <div class="content-subtitle">
                    AlwaysCare Clinic Center is at the forefront of in medical science and is one the most popular central in Singapore. 
                    Our Doctors ranks among the top 1% of hospitals in the world for different categories.
                    We're available not just locally but globally around the world, providing all treatment modalities. 
                    We’re continuously enriching and expanding services to meet the growing needs.
                </div>
                <div class="content-foot">
                    Abraham Zach
                </div>
                <div class="content-foot-image">
                    <img src="../images/signature-transparent.png" alt="signature">
                </div>
            </div>
        </div>
        <?php include('../components/about/banner.php'); ?>
        <div class="content darker-background">
            <div class="content-wrapper">
                <div class="content-title">
                    <h2>
                        High-class <span class="text-teal">specialists doctors</span> are always ready to <br>
                        help and care for you anytime
                    </h2>
                </div>
                <div class="content-subtitle">
                    Check our databases for choice of doctors, book a schedule, and visit us at the scheduled time and get your treatment.
                </div>
                <div class="button-group">
                    <a class="button-primary button-md" href="doctors.php">
                            Browse Doctors
                    </a>
                </div>
            </div>
            <div class="content-wrapper-image">
                <img src="../images/about-banner-2.png" alt="about-banner-2">
            </div>
        </div>
    </div>
    <?php include('../components/footer.php'); ?>
</body>
</html>