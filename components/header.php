<?php set_include_path(__DIR__.'/'); ?>
<?php 
    include_once('theme.php');
    ini_set('session.cookie_httponly', '1');
    session_start();
    use \Main\ThemeData as Theme;
?>
<header>
    <?php if( $currentPage !== 'Appointments') { ?>
        <section class="header-container bg-1">
            <h1 class="header"><img src="../images/logo-only-transparent.png" alt="logo"><?php echo Theme::brandName; ?></h1>
            <div class="intro-box">
                <span class="subtitle">Welcome to <?php echo Theme::brandName; ?> Clinic <?php echo isset($_SESSION['email']) && $_SESSION['loggedin'] === true ? ', '.htmlspecialchars($_SESSION['email']) : ''; ?></span>
                <span class="title">The best doctors are always caring for you</span>
                <div class="button-group">
                    <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) { ?>
                        <div class="action">
                            <a href="../php/login.php">Log In</a>
                        </div>
                    <?php } else { ?>
                        <div class="action">
                            <a href="../php/logout.php">Log out</a>
                        </div>
                        <a href="appoint.php" class="button-primary button-md">Make Appointment</a>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="header-container bg-2">
            <h1 class="header"><img src="../images/logo-only-transparent.png" alt="logo"><?php echo Theme::brandName; ?></h1>
            <div class="intro-box">
                <span class="subtitle">Doctors of <?php echo Theme::brandName; ?> Clinic are ready</span>
                <span class="title">Setting up an appointment is simple</span>
                <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) { ?>
                    <div class="action">
                        <a href="../php/login.php">Log In</a>
                    </div>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
</header>