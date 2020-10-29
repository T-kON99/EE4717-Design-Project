<?php set_include_path(__DIR__.'/'); ?>
<?php
    require_once('../../php/config.php');
    require_once('../theme.php');
    use \Main\ThemeData as Theme;
    session_start();
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] === true || $_SESSION["type"] === "doctor") {
        header("location: ../../php/login.php");
        exit;
    }
    $id = $_GET["doctor_id"];
    // TODO:
    // Add the left join to the doctor messages after feeding dummy data to doctor messages
    $sql_query = 'SELECT doctors.category_id AS category_id, doctors.id AS id, doctors_messages.details AS info_long, doctors_messages.introduction AS info_short, doctors.name AS name, doctors.rating AS rating, doctors.address AS address, doctors.image_link AS image_link, categories.name AS category, categories.icon_link as category_image_link FROM doctors LEFT JOIN categories ON doctors.category_id=categories.id LEFT JOIN doctors_messages ON doctors.id = doctors_messages.doctors_id WHERE doctors.id = '.$id;
    $db = connect_db();
    $result = $db->query($sql_query);
    if(!$result) {
        die('ERROR: Could not fetch categories'.mysqli_connect_error());
    }
    $row = $result->fetch_assoc();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../images/favicon.png"/>
    <link rel="stylesheet" href="../../css/doctors/doctorDetails.css">
    <script src="../../js/doctors/doctorDetails.js"></script>
    <title><?php echo $row["name"]; ?></title>
</head>
<body>
    <div class="bar">
        <div class="bar-wrapper">
            <div class="corner" id="back">
                <div className="go-corner">
                    <div class="go-arrow">←</div>
                </div>
            </div>
            <h1 class="header"><img src="../../images/logo-only-transparent.png" alt="logo"><?php echo Theme::brandName; ?></h1>
            <?php if($_SESSION["type"] !== "doctor") { ?>
                <div class="btn btn-secondary" id="btn-appoint">
                    <span>Book Appoinment</span>
                </div>
                <form action="../../pages/appoint.php" method="GET" id="form-hidden" class="hidden">
                        <input type="hidden" name="doctor_id" value="<?php echo $row["id"]; ?>">
                        <input type="hidden" name="category_id" value="<?php echo $row["category_id"] ?>">
                </form>
            <?php } ?>
        </div>
    </div>
    <div class="content">
        <div class="content-wrapper">
            <div class="image">
                <img src="<?php echo '../'.$row["image_link"] ?>" alt="<?php echo $row["name"]; ?>">
            </div>
            <div class="info">
                <div class="info-wrapper">
                    <div class="info-title">
                        <h1><?php echo $row["name"]; ?></h1>
                    </div>
                    <div class="info-short">
                        @<?php echo $row["address"]; ?>
                    </div>
                    <div class="info-subtitle">
                        <h2><?php echo $row["category"]; ?> <img src="<?php echo '../'.$row["category_image_link"]; ?>" alt="<?php echo $row["category"]; ?>"></h2>
                    </div>
                    <div class="info-short">
                        <?php echo $row['info_short']; ?>
                    </div>
                    <div class="info-long">
                        <?php echo $row['info_long']; ?>
                    </div>
                    <div class="info-foot">
                        Recommended by <?php echo $row['rating']; ?> out of 5 people.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>