<?php namespace Main;
    $currentPage = 'Doctors';
    $title = 'Doctors';
    $fname = 'doctors';
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
        <section class="card-container" id="category-cards-container">
            <?php include('../components/categoryCards.php'); ?>
        </section>
        <section class="cross-card-container" id="doctors-cards-container">
            <?php include('../components/doctorCards.php'); ?>
        </section>
    </div>
    <?php include('../components/footer.php'); ?>
</body>
</html>