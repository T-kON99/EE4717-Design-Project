<?php namespace Main\Navbar;?>
<?php include('theme.php');?>
<div class="navbar-wrapper">
    <ul class="navbar" id="navbar">
        <?php
            use Main;
            foreach(\Main\ThemeData::$urls as $name => $link) {
                print '<li class="nav-item ' . (($currentPage === $name) ? 'active"' : '"') . '>' . '<a ' . 'href="' . $link . '">' . $name . '</a></li>';
            }
        ?>
    </ul>
</div>
