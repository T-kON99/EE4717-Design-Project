<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    define('__SQL_SCRIPT_PATH__', __ROOT__.'/sql/');
    define('__SQL_SCRIPT_PREFIX__', 'create_');
    require_once(__ROOT__.'/php/config.php');
    require_once(__ROOT__.'/utils/populate.php');
    $exclude_files = array('.' => true, '..' => true, 'cleanup.sql' => true, 'README.md' => true);
    $i = 0;
    foreach(scandir(__SQL_SCRIPT_PATH__) as $path) {
        if(!array_key_exists($path, $exclude_files)) {
            $i++;
            $prefix_sql = str_pad(strval($i), 2, '0', STR_PAD_LEFT).'_'.__SQL_SCRIPT_PREFIX__;
            echo $prefix_sql;
            if(strpos($path, $prefix_sql) === 0) {
                $table_name = str_replace('.sql', '', str_replace($prefix_sql, '', $path));
                echo 'Populating table: '.$table_name."\n";
                populate_data($table_name);
            }
        }
    }
?>