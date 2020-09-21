<?php
    if(session_id() == '') {
        session_start();
    }
    /** If there is post request the request will be saved in session
    ** request that is saved is including
    ** specialization, date, doctor, orderBy
    */
    if(isset($_POST['specialization'])){
        $_SESSION['specialization'] = $_POST['specialization'];
        echo $_POST['specialization'];
    }
    if(isset($_POST['dateChoose'])){
        $_SESSION['dateChoose'] = $_POST['dateChoose'];
    }
    if(isset($_POST['doctorChoose'])){
        $_SESSION['doctorChoose'] = $_POST['doctorChoose'];
    }
    if(isset($_POST['orderBy'])){
        $_SESSION['orderBy'] = $_POST['orderBy'];
    }
    echo $_SESSION['doctorChoose'];
?>
