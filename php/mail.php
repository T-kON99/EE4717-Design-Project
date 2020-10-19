<?php
    define('__ROOT_EMAIL__', 'f36ee@f36ee.com');
    $subject = $_POST["subject"];
    $body = $_POST["body"];
    $error = "";
    if(!empty(trim($subject)) && !empty(trim($body))) {
        mail(__ROOT_EMAIL__, $subject, $body);
    }
    else {
        $error = "Empty subject or body!";
    }
    header("refresh:3;url=/pages/index.php"); 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting</title>
</head>
<body>
    <?php echo empty($error) ? "Your response has been recorded." : $error ?> You'll be redirected in few seconds.
</body>
</html>