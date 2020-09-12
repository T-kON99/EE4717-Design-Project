<?php namespace Main;
    /*
        Set out dynamic variable for us to use.
    */
    class ThemeData {
        const navbarColor_nonactive = "rgb(52, 107, 174)";
        const navbarColor_hover = "rgb(52, 107, 174)";
        const navbarColor_click = "rgb(52, 107, 174)";
        const navbarColor_active = "rgb(52, 107, 174)";
        
        const navbarTextColor_nonactive = "white";
        const navbarTextColor_hover = "rgb(10, 173, 203)";
        const navbarTextColor_click = "white";
        const navbarTextColor_active = "rgb(10, 173, 203)";
        const navbarTransition = "0.3s";

        const brandName = "AlwaysCare";
        
        public static $urls = array(
            'Home' => 'index.php',
            'About Us' => 'about.php',
            'Doctors' => 'doctors.php',
            'Appointments' => 'appoint.php',
            'Contacts' => 'contact.php',
        );
    }
?>