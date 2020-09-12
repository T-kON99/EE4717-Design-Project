<?php
    $exclude_files = array(basename(__FILE__) => true, '.' => true, '..' => true, 'unittest.php' => true);
    $failed_files = array();
    $n_success = 0;
    $n_tests = 0;
    echo "Running Tests\n";
    echo "------------------------------------------------------------\n";
    foreach(scandir(__DIR__) as $path) {
        if(!array_key_exists($path, $exclude_files)) {
            //  Only if files starts with test_
            if(strpos($path, 'test_') === 0) {
                $n_tests++;
                $status = shell_exec('php -f ./tests/'.$path);
                echo 'Testing:    '.basename($path).' -> '.$status;
                if($status === "FAILED\n") {
                    array_push($failed_files, $path);
                } else {
                    $n_success++;
                }
            }
            else {
                echo 'Skipping '.$path."\n";
            }
        }
    }
    echo "------------------------------------------------------------\n";
    echo $n_success.'/'.$n_tests.' test(s) succeeded'."\n";
    echo "------------------------------------------------------------\n";
    if($n_tests > $n_success) {
        echo count($failed_files).' test(s) failed:'."\n";
        foreach($failed_files as $fail_path) {
            echo $fail_path."                           X\n";
        }
        echo "------------------------------------------------------------\n";
        echo 'SOME TESTS FAILED... (OOPS)';
    } else {
        echo 'ALL TESTS PASSED (OK)';
    }
?>