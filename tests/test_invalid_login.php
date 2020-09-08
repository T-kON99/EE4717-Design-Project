<?php
    //  Includes and setups
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/php/config.php');
    require_once(__ROOT__.'/tests/unittest.php');

    //  Extend UnitTest class and fill relevant methods
    class Test extends UnitTest {
        function __construct() {
            $this->db_con = connect_db();
            $this->email = "abcde@example.com";
            $this->password = "abcde";
            parent::__construct();
        }

        function setup() {
            $this->db_con->query('INSERT IGNORE INTO users (email, password) VALUES ('.$this->email.','.password_hash($this->password, PASSWORD_DEFAULT).')');
        }

        function test() {
            $res_html = post_request('http://localhost:3000/php/login.php', array("email" => $this->email, "password" => "ababab"));
            return strpos($res_html, '<title>Home</title>') === false ? $this->SUCCESS : $this->FAILED;
        }

        function cleanup() {
            $this->db_con->query('DELETE FROM users WHERE email='.$this->email);
        }
    }
    //  Constructor call will automatically run test.
    $test = new Test();
?>