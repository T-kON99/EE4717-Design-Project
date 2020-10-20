<?php

    include_once '../../utils/array_PostToPhp.php';
    include_once 'weeklySqlHelper.php';
    include_once '../../php/config.php';

    function verifyAsDoctor($doctorId, $userId, $type){
        if(is_null($doctorId) || is_null($userId) || is_null($type)){
            return false;
        }
        if($type!='doctor'){
            return false;
        }
        return true;
    }

    function isValidTime($time, $format = 'H:i:s')
    {
        $dateObj = DateTime::createFromFormat($format, $time);
        return $dateObj && $dateObj->format($format) == $time;
    }

    function checkTime($time){
        if(!isValidTime($time)){
            echo "not valid time:".$time;
            // print_r('timeArray:'.$timeArray);
            // print($timeArrayPost);
            exit();
        };
    }

    function checkWeekday($weekday){
        if($weekday>7 || $weekday < 1){
            echo "not valid weekday:".$weekday;
            // print_r('weekdayArray:'.$weekdayArray);
            // print($weekdayArrayPost);
            exit();
        };
    }

    function processWeekTimePacked($weekTimePacked){
        print($weekTimePacked);
        $weekTimeArray = explode(';', $weekTimePacked);
        $weekdayArray = array();
        $timeArray = array();
        foreach($weekTimeArray as $weekTimeString){
            $arr = explode(',', $weekTimeString);
            $weekday = $arr[0];
            $time = $arr[1];
            checkWeekday((int)$weekday);
            checkTime($time);
            array_push($weekdayArray, $weekday);
            array_push($timeArray, $time);
        }
        return array($weekdayArray, $timeArray);
    }


    session_start();

    $doctorId = isset($_SESSION['doctorId']) ? $_SESSION['doctorId'] : NULL;
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : NULL;

    if(!verifyAsDoctor($doctorId, $userId, $type)){
        echo 'Please Log In As Doctor...';
        exit();
    };

    $weekTimePacked = isset($_POST['weekTimePacked']) ? $_POST['weekTimePacked'] : NULL;

    if(is_null($weekTimePacked)){
        echo 'Please Choose TimeSlot';
        exit();
    }
    $weekdayArray = NULL;
    $timeArray = NULL;
    {
        $arr = processWeekTimePacked($weekTimePacked);
        $weekdayArray = $arr[0];
        $timeArray = $arr[1];
    }

    if(sizeof($timeArray)!==sizeof($weekdayArray)){
        echo 'Size of Time Array and Week Array not equal!';
        exit();
    }

    $conn = connect_db();
    for($i = 0; $i< sizeof($weekdayArray); $i++){
        $weekday = $weekdayArray[$i];
        $time = $timeArray[$i];
        if(!checkDoctorWeeklyAvailableTimeOnly($conn, $doctorId, $weekday, $time)){
            insertDoctorWeeklyAvailable($conn, $doctorId, $weekday, $time);
        }else{
            deleteDoctorWeeklyAvailable($conn, $doctorId, $weekday, $time);
        }
    }

?>
