<?php
    set_include_path(__DIR__.'/');
    require_once('config.php');
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header("location: ../pages/index.php");
        exit;
    }

    $email = $email_err = '';
    $password = $password_err = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db_conn = connect_db();

        if(!isset($_POST['email']) || !isset($_POST['password'])) {
            $email_err = $password_err = 'Invalid Request';
        }
        
        if(empty(trim($_POST['email'])) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) {
            $email_err = 'Please enter a valid email address';
        } else {
            $email = trim($_POST['email']);
        }

        if(empty(trim($_POST['password']))) {
            $password_err = 'Please enter password';
        } else {
            $password = trim($_POST['password']);
        }

        if(empty($email_err) && empty($password_err)) {
            $sql_query = 'SELECT id, email, type, password from users WHERE email = ?';
            if($stmt = mysqli_prepare($db_conn, $sql_query)) {
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = $email;

                //  Execute SQL
                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) === 1) {
                        mysqli_stmt_bind_result($stmt, $db_id, $db_email, $acc_type, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)) {
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $db_id;
                                $_SESSION["email"] = $db_email;
                                $_SESSION["type"] = $acc_type;
                                header("location: ../pages/index.php");
                            }
                            else {
                                $password_err = "Invalid email/password";
                            }
                        }
                    }
                    else {
                        $email_err = "Account "."'".$email."'"." does not exist";
                    }
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/favicon.png"/>
    <link rel="stylesheet" href="../css/auth.css">
    <script src="../js/auth.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="center">
        <div class="wrapper">
            <h2>Login</h2>
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
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            </form>
        </div>    
    </div>
</body>
</html>