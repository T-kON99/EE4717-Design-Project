<?php
    set_include_path(__DIR__.'/');
    require_once('config.php');
    session_start();

    $doctor_id = $doctor_id_err = "";
    $user_id = $user_id_err = "";
    $name = $name_err = "";
    $intro = $intro_err = "";
    $details = $details_err = "";
    $success_msg = $success_msg_messages = "";
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['type'] !== 'doctor') {
        header("location: ../php/login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        $db_conn = connect_db();
        if(!isset($_POST["name"]) || !isset($_POST["introduction"]) || !isset($_POST["details"]) || !isset($_POST["doctor_id"])) {
            $name_err = $intro_err = $details_err = "Invalid Request";
        }

        if(empty(trim($_POST["name"]))) {
            $name_err = "Name cannot be empty!";
        } else {
            $name = trim($_POST["name"]);
        }

        if(empty(trim($_POST["introduction"]))) {
            $intro_err = "Introduction cannot be empty!";
        } else {
            $intro = trim($_POST["introduction"]);
        }

        if(empty(trim($_POST["details"]))) {
            $details_err = "Details can't be empty!";
        } else {
            $details = trim($_POST["details"]);
        }

        if(empty(trim($_POST["doctor_id"]))) {
            $doctor_id_err = "Invalid doctor id";
        } else {
            $doctor_id = (int)trim($_POST['doctor_id']);
        }

        if(empty(trim($_POST["user_id"]))) {
            $user_id_err = "Invalid user id";
        } else {
            $user_id = (int)trim($_POST['user_id']);
        }

        if(empty($name_err) && empty($intro_err) && empty($details_err) && empty($doctor_id_err)) {
            $sql_query = 'UPDATE doctors SET name = ? WHERE id = ?';
            $sql_query_messages = 'UPDATE doctors_messages SET introduction = ?, details = ? WHERE doctors_id = ?';
            if($stmt = mysqli_prepare($db_conn, $sql_query)) {
                mysqli_stmt_bind_param($stmt, "si", $param_name, $param_doctor_id);
                $param_name = $name;
                $param_doctor_id = $doctor_id;

                //  Execute 1st SQL
                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_affected_rows($stmt) === 1) {
                        $success_msg = "Succesfully updated name!";
                    }
                } else {
                    $name_err = "Name "."'".$name."'"." is invalid!";
                }
            }
            mysqli_stmt_close($stmt);
            if($stmt_messages = mysqli_prepare($db_conn, $sql_query_messages)) {
                mysqli_stmt_bind_param($stmt_messages, "ssi", $param_intro, $param_details, $param_doctor_id);
                $param_name = $name;
                $param_doctor_id = $doctor_id;
                $param_intro = $intro;
                $param_details = $details;

                //  Execute 2nd SQL
                if(mysqli_stmt_execute($stmt_messages)) {
                    mysqli_stmt_store_result($stmt_messages);
                    if(mysqli_stmt_affected_rows($stmt_messages) === 1) {
                        $success_msg_messages = "Succesfully updated introduction and details!";
                    }
                } else {
                    $intro_err = "Introduction "."'".$intro."'"." is invalid!";
                    $details_err = "Details "."'".$details."'"." is invalid!";
                }
            }
            mysqli_stmt_close($stmt_messages);
        }
        if((!empty($success_msg) && !empty($success_msg_messages)) || (empty($name_err) && empty($intro_err) && empty($details_err))) {
            header("location: ../components/doctors/doctorChangeDetails.php?user_id=".$user_id.'&doctor_id='.$doctor_id.'&success=true');
        }
        else {
            header("location: ../components/doctors/doctorChangeDetails.php?user_id=".$user_id.'&doctor_id='.$doctor_id.'&name_err='.$name_err.'&intro_err='.$intro_err.'&details_err='.$details_err);
        }
    }
?>