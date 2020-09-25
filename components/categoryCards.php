<?php set_include_path(__DIR__.'/'); ?>
<?php
    require_once('../php/config.php');
    $sql_query = 'SELECT * FROM categories ORDER BY name';
    $db = connect_db();
    $result = $db->query($sql_query);
    if(!$result) {
        die('ERROR: Could not fetch categories'.mysqli_connect_error());
    }
?>
<?php while($row = $result->fetch_assoc()): ?>
<?php 
    $category = $row["name"];
    $icon_link = $row["icon_link"];
    $description = $row["description"];
?>
<div class="card-row-sm card-0" id="<?php echo $category.'-card'; ?>">
    <div class="card-col-sm icon-sm">
        <div class="card-icon-sm"><img src="<?php echo $icon_link; ?>" alt="<?php echo $category.'-icon'; ?>"></div>
    </div>
    <div class="card-col-sm description">
        <div class="card-title-sm"><?php echo $category; ?></div>
        <hr class="card-separator-sm">
        <div class="card-subtitle-sm">
            <?php echo $description; ?>
        </div>
    </div>
</div>
<?php endwhile ?>
<?php
    $result->free();
    $db->close();
?>