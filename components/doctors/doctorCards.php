<?php set_include_path(__DIR__.'/'); ?>
<?php
    require_once('../php/config.php');
    @session_start();
    $sql_query = 'SELECT doctors_messages.introduction AS introduction, doctors.id, doctors.name, doctors.rating, doctors.address, doctors.image_link, categories.name AS category, categories.icon_link AS icon_link FROM doctors LEFT JOIN categories ON categories.id=doctors.category_id LEFT JOIN doctors_messages ON doctors.id=doctors_messages.doctors_id ORDER BY categories.name';
    $db = connect_db();
    $result = $db->query($sql_query);
    if(!$result) {
        die('ERROR: Could not fetch categories'.mysqli_connect_error());
    }
?>
<?php while($row = $result->fetch_assoc()): ?>
<?php 
    $name = $row["name"];
    $image_link = $row["image_link"];
    $category = $row["category"];
    $doctor_id = $row["id"];
    $intro = $row["introduction"];
?>
<form method="GET" action="../components/<?php echo $fname; ?>/doctorDetails.php" class="<?php echo $_SESSION["type"] === "doctor" ? "not-clickable" : "" ?> card-row-xl card-doctor hidden <?php echo str_replace(' ', '_', $category); ?>" id="<?php echo $name.'-card-'.$doctor_id; ?>">
    <div class="card-col-xl icon-xl">
        <div class="card-icon-xl"><img src="<?php echo $image_link; ?>" alt="<?php echo $name.'-icon'; ?>"></div>
    </div>
    <div class="card-col-xl description">
        <div class="card-title-xl"><?php echo $name; ?> | <?php echo $category; ?></div>
        <hr class="card-separator-xl">
        <div class="card-subtitle-xl">
            <?php echo $intro; ?>
        </div>
    </div>
    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id ?>">
</form>
<?php endwhile ?>
<?php
    $result->free();
    $db->close();
?>