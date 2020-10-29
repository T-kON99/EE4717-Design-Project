<?php 
    set_include_path(__DIR__.'/');
    require_once('../php/config.php'); 
    $db_con = connect_db();
    $result = $db_con->query('SELECT * FROM users WHERE type="patient"');
    $n_patients = $result->num_rows;
    $result = $db_con->query('SELECT * FROM users WHERE type="doctor"');
    $n_doctors = $result->num_rows;
    $result = $db_con->query('SELECT * FROM appointments');
    $n_cases = $result->num_rows;
    $result = $db_con->query('SELECT AVG(rating) AS avg_rating FROM doctors');
    $rating = $result->fetch_assoc()["avg_rating"];
?>
<section class="info-banner">
    <div class="banner">
        <div class="container">
            <div class="main-banner">
                <div class="banner-item">
                    <div class="box-item">
                        <div class="box-counter"><?php echo $n_patients; ?></div>
                        <div class="box-title">
                            Patients
                            <br>
                            Registered
                        </div>
                    </div>
                </div>
                <div class="banner-item">
                    <div class="box-item">
                        <div class="box-counter"><?php echo $n_doctors; ?></div>
                        <div class="box-title">
                            Doctors 
                            <br>
                            Registered
                        </div>
                    </div>
                </div>
                <div class="banner-item">
                    <div class="box-item">
                        <div class="box-counter"><?php echo $n_cases; ?></div>
                        <div class="box-title">
                            Patients
                            <br>
                            Treated
                        </div>
                    </div>
                </div>
                <div class="banner-item">
                    <div class="box-item">
                        <div class="box-counter"><?php echo round($rating, 1); ?>/5</div>
                        <div class="box-title">Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
