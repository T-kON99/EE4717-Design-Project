<?php
    class CSV_Parser {
        function __construct($filepath) {
            if(!file_exists($filepath)) {
                die('ERROR: File '.$filepath." does not exist, exiting...\n");
            }
            $csv = array_map('str_getcsv', file($filepath));
            array_walk($csv, function(&$a) use ($csv) {
                $a = array_combine($csv[0], $a);
            });
            $headers = array_keys($csv[0]);
            array_shift($csv); # remove column header
            $this->headers = $headers;
            $this->csv = $csv;
        }

        function get_csv() {
            return $this->csv;
        }

        function get_headers() {
            return $this->headers;
        }
    }
?>