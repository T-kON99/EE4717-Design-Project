<?php namespace Main;
    $currentPage = 'Home';
    $title = 'Home';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.php">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/<?php echo basename(__FILE__, '.php') . '.css'; ?>">
    <script src="../js/main.js"></script>
    <script src="../js/<?php echo basename(__FILE__, '.php') . '.js'; ?>"></script>
    <title><?php echo $title;?></title>
</head>
<body>
    <?php include('../components/header.php'); ?>
    <?php include('../components/navbar.php'); ?>
    <div class="root">
        This is the <?php echo $currentPage;?> page. Fill this with something....
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        <br><br><br><br>
        test
    </div>
    <?php include('../components/footer.php'); ?>
</body>
</html>