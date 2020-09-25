<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    define('__SQL_SCRIPT_PATH__', __ROOT__.'/sql/');
    require_once(__ROOT__.'/php/config.php');
    require_once(__ROOT__.'/utils/run_sql.php');

    run_sql_file(__SQL_SCRIPT_PATH__.'cleanup.sql');
?>