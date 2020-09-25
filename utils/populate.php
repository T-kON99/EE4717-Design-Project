<?php
    /*
        Populates data based from data folder. Given data should be in csv format for this utility function to work properly.
        It'll then perform sql queries to insert data correctly.
    */
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__."/classes/csv.php");
    require_once(__ROOT__.'/php/config.php');



    function populate_data($field) {
        $db = connect_db();
        $filepath = __ROOT__."/data/".$field.".csv";
        $normalize = function($value) {
            return "'".$value."'";
        };
        $hash = function(&$v, $k) {
            $v = $k === "password" ? password_hash($v, PASSWORD_DEFAULT) : $v;
        };
        $csv = new CSV_Parser($filepath);
        $header = join(',', $csv->get_headers());
        foreach($csv->get_csv() as $row) {
            array_walk($row, $hash);
            $values = join(',', array_map($normalize, array_values($row)));
            $sql_query = 'INSERT IGNORE INTO '.$field.' ('.$header.')'.' VALUES ('.$values.')';
            if($result = $db->query($sql_query)) {
                echo 'Executed SQL Query '.$values."\n";
            }
            else {
                echo '------ERROR------'."\n";
                echo mysqli_error($db)."\n";
                echo 'Last executed Query : '.$sql_query."\n";
            }
        }
    }
?>