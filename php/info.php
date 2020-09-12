<?php 
    set_include_path(__DIR__.'/');
    require_once('config.php'); 
    $db_con = connect_db();
    $result = $db_con->query('SELECT * FROM users WHERE type="patient"');
    $n_patients = $result->num_rows;
?>