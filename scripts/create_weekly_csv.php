<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    define('__SQL_SCRIPT_PATH__', __ROOT__.'/sql/');
    require_once(__ROOT__.'/php/config.php');
    require_once(__ROOT__.'/utils/run_sql.php');
    $exclude_files = array('.' => true, '..' => true, 'cleanup.sql' => true, 'README.md' => true);

    foreach(scandir(__SQL_SCRIPT_PATH__) as $path) {
        if(!array_key_exists($path, $exclude_files)) {
            if(run_sql_file(__SQL_SCRIPT_PATH__.$path)) {
                echo $path.' runs ok'."\n";
            }
            else {
                echo $path.' failed to run'."\n";
            }
        }
    }
?>
