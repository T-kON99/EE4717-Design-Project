<?php
    // ABSTRACT CLASS UNITTEST
    // status must be either FAILED or SUCCESS
    // Example refer to test_login.php
    abstract class UnitTest {
        abstract public function setup();
        abstract public function test();
        abstract public function cleanup();

        public function run() {
            $this->setup();
            $status = $this->test();
            $this->cleanup();
            return $status."\n";
        }
        // Constructor
        public function __construct() {
            // call this constructor last after initializing abstract functions.
            $this->SUCCESS = 'SUCCESS';
            $this->FAILED = 'FAILED';
            echo $this->run();
        }
    }
?>