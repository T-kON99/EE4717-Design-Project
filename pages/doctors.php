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
        <!-- TODO FINISH THIS FOR DOCTORS -->
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == 'doctor') { ?>
            <form method="GET" action="../components/<?php echo $fname; ?>/doctorChangeDetails.php" class="btn btn-primary" id="change-particular">
                Change Personal Particular
                <input type="hidden" name="user_id" value="<?php echo $_SESSION["id"]; ?>">
            </form>
        <?php } ?>
        <section class="card-container" id="category-cards-container">
            <?php include('../components/'.$fname.'/'.'categoryCards.php'); ?>
        </section>
        <section class="cross-card-container" id="doctors-cards-container">
            <?php include('../components/'.$fname.'/'.'doctorCards.php'); ?>
        </section>
    </div>
    <?php include('../components/footer.php'); ?>
</body>
</html>