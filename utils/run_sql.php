<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/php/config.php');
    function run_sql_file($filepath) {
        $sql_query = file_get_contents($filepath);
        $db = connect_db();
        $bool_status = false;
        if($result = $db->query($sql_query)) {
            $bool_status = true;
        }
        else {
            echo '-------------'."\n";
            echo mysqli_error($db)."\n";
        }
        $db->close();
        return $bool_status;
    }
?>