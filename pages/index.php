<?php namespace Main;
    $currentPage = 'Home';
    $title = 'Home';
    $fname = 'index';
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
        <section class="card-container">
            <div class="card-row card-1">
                <div class="card-col icon">
                    <div class="card-icon"><img src="../images/service-1-34x44.png" alt="service-1"></div>
                </div>
                <div class="card-col description">
                    <div class="card-title">Qualified Doctors</div>
                    <hr class="card-separator">
                    <div class="card-subtitle">
                        Doctors of AlwaysCare Clinic has guaranteed experienced skills to handle your daily health problems
                    </div>
                </div>
            </div>
            <div class="card-row card-2">
                <div class="card-col icon">
                    <div class="card-icon"><img src="../images/service-3-35x44.png" alt="service-3"></div>
                </div>
                <div class="card-col description">
                    <div class="card-title">24/7 Coverage</div>
                    <hr class="card-separator">
                    <div class="card-subtitle">
                        Facilities and personnels ready to handle emergency cases whenever it is
                    </div>
                </div>
            </div>
            <div class="card-row card-3">
                <div class="card-col icon">
                    <div class="card-icon"><img src="../images/service-2-48x34.png" alt="service-2"></div>
                </div>
                <div class="card-col description">
                    <div class="card-title">Emergency Ready</div>
                    <hr class="card-separator">
                    <div class="card-subtitle">
                        Life threatening situations are always our top priority, and is always prioritized
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="content-wrapper-text">
                <div class="content-title">
                    <h2>
                        Clinic that <span class="text-teal">prioritizes</span> your daily needs
                    </h2>
                </div>
                <div class="content-subtitle">
                    We provide the a wide range of medical services, so every person could have the opportunity to receive qualitative medical help.
                </div>
                <div class="content-list">
                    <ul class="custom">
                        <li>Adult and Children's Center</li>
                        <li>Birthing and Lactation Issues</li>
                        <li>Ear, Nose and Throat (ENT)</li>
                        <li>Interventional Cardiology</li>
                    </ul>
                    <ul class="custom">
                        <li>Dental and Oral Surgery</li>
                        <li>Cardiac Support Groups</li>
                        <li>Heart and Vascular Institute</li>
                        <li>Emergency Pediatric Care</li>
                    </ul>
                </div>
                <div class="button-group">
                    <a class="button-primary button-md" href="about.php">
                            Read More
                    </a>
                </div>
            </div>
            <div class="content-wrapper-image">
                <img src="../images/banner.png" alt="banner">
            </div>
        </section>
    </div>
    <?php include('../components/footer.php'); ?>
</body>
</html>