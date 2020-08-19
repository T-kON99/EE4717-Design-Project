<?php 
    header("Content-type: text/css; charset: UTF-8");
    require('../components/theme.php');
    use \Main\ThemeData as Theme;
?>

.sticky {
    position: fixed;
    top: 0;
    width: 100%;
}

.sticky + .root {
    padding-top: 60px;
}

ul.navbar {
    float: right;
    list-style: none;
    width: 100%;
    background-color: <?php echo Theme::navbarColor_nonactive;?>;
    margin: 0;
    padding: 0;
    text-align: center;
    overflow: auto;
}

.navbar li.nav-item {
    display: inline-block;
    width: calc(100% / <?php echo count(Theme::$urls);?>);
}

.navbar li.nav-item a:hover {
    color: <?php echo Theme::navbarTextColor_hover;?>;
    background-color: <?php echo Theme::navbarColor_hover;?>;
}

.navbar li a {
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 1.2em;
    width: 100%;
    display: block;
    text-decoration: none;
    text-align: center;
    color: <?php echo Theme::navbarTextColor_nonactive;?>;
}

.navbar li.active a {
    color: <?php echo Theme::navbarTextColor_active;?>;
    background-color: <?php echo Theme::navbarColor_active;?>;
}

@media screen and (max-width: 750px) {
    .navbar li.nav-item {
        float: none;
        display: block;
        width: 100%;
        /* text-align: left; */
    }

    .navbar li.nav-item a {
        /* text-align: left; */
    }
}