<?php
    define('__ROOT_EMAIL__', 'f36ee@EE-IM-4717');
    set_include_path(__DIR__.'/');
    require_once('config.php');
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header("location: ../pages/index.php");
        exit;
    }

    $email = $email_err = '';
    $password = $password_err = '';
    $con_password = $con_password_err = '';
    $success_msg = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db_conn = connect_db();

        if(!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['con_password'])) {
            $email_err = $password_err = $con_password_err = 'Invalid Request';
        }

        if(empty(trim($_POST['email'])) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) {
            $email_err = 'Please enter a valid email address';
        } else {
            $email = trim($_POST['email']);
        }

        if(empty(trim($_POST['password'])) || strlen($_POST['password']) < 6) {
            $password_err = 'Please enter password of at least 6 characters long';
        } else {
            $password = trim($_POST['password']);
        }

        if(empty(trim($_POST['con_password']))) {
            $con_password_err = 'Please confirm password';
        } else {
            $con_password = trim($_POST['con_password']);
            $con_password_err = $_POST['con_password'] !== $_POST['password'] ? 'Password does not match' : '';
        }

        if(empty($email_err) && empty($password_err) && empty($con_password_err)) {
            // Don't throw error when duplicate email found.
            $insert_query = 'INSERT IGNORE INTO users (email, password) VALUES (?, ?)';
            if($stmt = mysqli_prepare($db_conn, $insert_query)) {
                mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_hashed_password);
                $param_email = $email;
                $param_hashed_password = password_hash($password, PASSWORD_DEFAULT);

                //  Execute SQL
                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_affected_rows($stmt) === 1) {
                        $success_msg = "Succesfully created account!";
                        $subject = "Welcome ".$email."!";
                        $body = "Welcome to the big family!";
                        $error = "";
                        $headers = "From: alwayscare@alwayscare.com";
                        mail(__ROOT_EMAIL__, $subject, $body, $headers);
                        header("refresh:3;url=login.php"); 
                    } else {
                        $email_err = "Account "."'".$email."'"." already exists";
                    }
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/favicon.png"/>
    <link rel="stylesheet" href="../css/auth.css">
    <script type="text/javascript" src="../js/auth.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="center">
        <div class="box">
            <div class="corner" id="back">
                <div className="go-corner">
                    <div class="go-arrow">←</div>
                </div>
            </div>
            <div class="wrapper">
                <?php if(!empty($success_msg)) { ?>
                    <div class="status success"><?php echo $success_msg; ?> You'll be redirected to login page soon or click <a href="login.php">here</a></div>
                <?php } ?>
                <h2>Signup</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>">
                        <span id="help-email" class="help-block"><?php echo $email_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span id="help-password" class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($con_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="con_password" class="form-control" placeholder="Reenter Password">
                        <span id="help-password" class="help-block"><?php echo $con_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Create Account">
                    </div>
                    <p>Already have an account? <a href="login.php">Login now</a>.</p>
                </form>
            </div>    
        </div>
    </div>
</body>
</html>