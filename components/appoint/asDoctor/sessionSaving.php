<?php
    {
        if(session_id() == '') {
            session_start();
        }

        include_once dirname(__FILE__) . '/../../../serverLogic/sqlHandler.php';
        include_once realpath(dirname(__FILE__) . '/../../../php/config.php');
        $conn = connect_db();
        /** If there is post get the request will be saved in session
        ** request that is saved is including
        ** category_id, date, doctor, orderBy
        */
        if(isset($_GET['dateChoose'])){
            $_SESSION['dateChoose'] = $_GET['dateChoose'];
            echo $_GET['dateChoose'];
        }
        if(isset($_SESSION['id'])){
            $_SESSION['doctorId'] = getDoctorIdFromUserId($conn, $_SESSION['id']);
        }else{
            $_SESSION['doctorId'] = NULL;
        }
        if(isset($_GET['orderBy'])){
            $_SESSION['orderBy'] = $_GET['orderBy'];
        }
    }
?>
