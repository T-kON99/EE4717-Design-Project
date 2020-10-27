<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'f36ee');
    define('DB_PASSWORD', 'f36ee');
    define('DB_NAME', 'f36ee');
    @ini_set('session.cookie_httponly', '1');

    function connect_db($server = DB_SERVER, $username = DB_USERNAME, $password = DB_PASSWORD, $dbname = DB_NAME) {
        $db_connection = mysqli_connect($server, $username, $password, $dbname);
        // Check connection
        if(!$db_connection){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $db_connection;
    }

    // Typehinting array/objects still work in PHP5
    function post_request($url, array $params) {
        $query_content = http_build_query($params);
        $fp = fopen(
            $url,
            'r',
            FALSE, // do not use_include_path
            stream_context_create([
                'http' => [
                    'header'  => [ // header array does not need '\r\n'
                        'Content-type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen($query_content)
                    ],
                    'method'  => 'POST',
                    'content' => $query_content
                ]
            ])
        );
        if ($fp === FALSE) {
            return json_encode(['error' => 'Failed to get contents...']);
        }
        $result = stream_get_contents($fp); // no maxlength/offset
        fclose($fp);
        return $result;
    }
?>
