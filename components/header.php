<?php set_include_path(__DIR__.'/'); ?>
<?php 
    include_once('theme.php');
    use \Main\ThemeData as Theme;
?>
<header>
    <?php if( $currentPage !== 'Appointments') { ?>
        <section class="header-container bg-1">
            <h1 class="header"><img src="../images/logo-only-transparent.png" alt="logo"><?php echo Theme::brandName; ?></h1>
            <div class="intro-box">
                <span class="subtitle">Welcome to <?php echo Theme::brandName; ?> Clinic</span>
                <span class="title">The best doctors are always caring for you</span>
                <div class="button-group">
                    <a href="appoint.php" class="button-primary button-md">Make Appointment</a>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="header-container bg-2">
            <h1 class="header"><img src="../images/logo-only-transparent.png" alt="logo"><?php echo Theme::brandName; ?></h1>
            <div class="intro-box">
                <span class="subtitle">Doctors of <?php echo Theme::brandName; ?> Clinic are ready</span>
                <span class="title">Setting up an appointment is simple</span>
            </div>
        </section>
    <?php } ?>
</header>