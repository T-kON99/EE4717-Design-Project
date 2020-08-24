<?php namespace Main\Navbar;?>
<?php set_include_path(__DIR__.'/') ?>
<?php include_once('theme.php');?>
<div class="navbar-wrapper" id="navbar-wrapper">
    <ul class="navbar" id="navbar">
        <?php
            foreach(\Main\ThemeData::$urls as $name => $link) {
                print '<li class="nav-item ' . (($currentPage === $name) ? 'active"' : '"') . '>' . '<a ' . 'href="' . $link . '">' . $name . '</a></li>';
            }
        ?>
    </ul>
</div>
