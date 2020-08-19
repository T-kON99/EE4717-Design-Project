<?php namespace Main;
    /*
        Set out dynamic variable for us to use.
    */
    class ThemeData {
        public const navbarColor_nonactive = "rgb(52, 107, 174)";
        public const navbarColor_hover = "rgb(52, 107, 174)";
        public const navbarColor_click = "rgb(52, 107, 174)";
        public const navbarColor_active = "rgb(52, 107, 174)";
        
        public const navbarTextColor_nonactive = "white";
        public const navbarTextColor_hover = "rgb(10, 173, 203)";
        public const navbarTextColor_click = "white";
        public const navbarTextColor_active = "rgb(10, 173, 203)";

        public static $urls = array(
            'Home' => 'index.php',
            'About Us' => 'about.php',
            'Doctors' => 'doctors.php',
            'Appointments' => 'appoint.php',
            'Contacts' => 'contact.php',
        );
    }
?>