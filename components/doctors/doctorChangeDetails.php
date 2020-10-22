<?php set_include_path(__DIR__.'/'); ?>
<?php
    require_once('../../php/config.php');
    require_once('../theme.php');
    use \Main\ThemeData as Theme;
    session_start();
    if (!isset($_SESSION['loggedin']) || !($_SESSION['loggedin'] === true) || !isset($_SESSION['type']) || !($_SESSION['type'] === 'doctor')) {
        header("location: ../../php/login.php");
        exit;
    }
    $id = $_GET["user_id"];
    $sql_query = 'SELECT doctors.id as id, doctors_messages.details AS info_long, doctors_messages.introduction AS info_short, doctors.name AS name, doctors.rating AS rating, doctors.address AS address, doctors.image_link AS image_link, categories.name AS category, categories.icon_link as category_image_link FROM doctors LEFT JOIN categories ON doctors.category_id=categories.id LEFT JOIN doctors_messages ON doctors.id = doctors_messages.doctors_id WHERE doctors.user_id = '.$id;
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
    <link rel="icon" type="image/png" href="../images/favicon.png"/>
    <link rel="stylesheet" href="../../css/doctors/doctorDetails.css">
    <script src="../../js/doctors/doctorChangeDetails.js"></script>
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
            <!-- TODO Disable this button if you're the doctor -->
            <div class="btn btn-secondary" id="btn-appoint">
                <span>Update Particular</span>
                <!-- TODO: Make appoinment by sending a get request to appoinment page.  -->
            </div>
        </div>
    </div>
    <form class="content" method="POST" action="../../php/update_info.php" id="form-particular">
        <div class="content-wrapper">
            <div class="image">
                <img src="<?php echo '../'.$row["image_link"] ?>" alt="<?php echo $row["name"]; ?>">
            </div>
            <div class="info">
                <div class="info-wrapper">
                    <div class="form-group">
                        <h1><input type="text" class="form-input" name="name" size="20" value="<?php echo $row["name"]; ?>"></h1>
                        <span id="help-name" class="help-block"><?php echo isset($_GET["name_err"]) && !empty($_GET["name_err"]) ? $_GET["name_err"] : ''; ?></span>
                    </div>
                    <div class="info-short">
                        @<?php echo $row["address"]; ?>
                    </div>
                    <div class="info-subtitle">
                        <h2><?php echo $row["category"]; ?> <img src="<?php echo '../'.$row["category_image_link"]; ?>" alt="<?php echo $row["category"]; ?>"></h2>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="introduction" size="100" value="<?php echo $row['info_short']; ?>">
                        <span id="help-intro" class="help-block"><?php echo isset($_GET["intro_err"]) && !empty($_GET["intro_err"]) ? $_GET["intro_err"] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <textarea name="details" class="form-input" cols="100" rows="20"><?php echo $row['info_long']; ?></textarea>
                        <span id="help-details" class="help-block"><?php echo isset($_GET["details_err"]) && !empty($_GET["details_err"]) ? $_GET["details_err"] : ''; ?></span>
                    </div>
                    <?php if(isset($_GET["success"])): ?>
                        <div class="info-success">
                            Successfully updated record!
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="doctor_id" value="<?php echo $row["id"]; ?>">
        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
    </form>
</body>
</html>