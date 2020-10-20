<?php
    if(session_id() == '') {
        session_start();
    }
    /** If there is post request the request will be saved in session
    ** request that is saved is including
    ** category_id, date, doctor, orderBy
    */
    if(isset($_GET['category_id'])){
        $_SESSION['category_id'] = $_GET['category_id'];
    }
    if(isset($_GET['dateChoose'])){
        $_SESSION['dateChoose'] = $_GET['dateChoose'];
        echo $_GET['dateChoose'];
    }
    if(isset($_GET['doctorId'])){
        $_SESSION['doctorId'] = $_GET['doctorId'];
        echo $_GET['doctorId'];
    }
    if(isset($_GET['orderBy'])){
        $_SESSION['orderBy'] = $_GET['orderBy'];
    }
?>
