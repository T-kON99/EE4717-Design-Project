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
                    <div class="card-icon"><img src="../images/card-1.png" alt="card-1"></div>
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
                    <div class="card-icon"><img src="../images/card-1.png" alt="card-1"></div>
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
                    <div class="card-icon"><img src="../images/card-1.png" alt="card-1"></div>
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
    </div>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>

    <?php include('../components/footer.php'); ?>
</body>
</html>