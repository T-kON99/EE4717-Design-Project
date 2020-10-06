<?php namespace Main;
    $currentPage = 'Contacts';
    $title = 'Contacts';
    $fname = 'contact';
?>
<?php set_include_path(__DIR__.'/') ?>
<html lang="en">
<head>
    <?php include('../components/head.php'); ?>
    <script src="../js/module/contact.js" type="module"></script>
</head>
<body>
    <?php include('../components/header.php'); ?>
    <?php include('../components/navbar.php'); ?>
    <div class="root">
        <div class="content">
            <h2>
                Ask us any questions or feedbacks and
                <span class="text-teal">visit our clinic</span>
            </h2>
            <div class="contact-wrapper">
                <div class="address-wrapper">
                    <div class="address">
                        <span class="title">Singapore</span>
                        <span>50 Nanyang Ave, 639798</span>
                        <span>Phone: 111-222-333</span>
                    </div>
                    <div class="address">
                        <span class="title">Singapore</span>
                        <span>123 Nanyang Ave, 123123</span>
                        <span>Phone: 123-123-123</span>
                    </div>
                    <div class="address">
                        <span class="title">Singapore</span>
                        <span>321 Bugis Road, 321321</span>
                        <span>Phone: 321-321-321</span>
                    </div>
                    <div class="address">
                        <span class="title">Singapore</span>
                        <span>123 Tanjong Pagar, 112233</span>
                        <span>Phone: 333-222-111</span>
                    </div>
                </div>
                <div class="form-contact">
                    <form action="../php/mail.php" method="POST" id="formcontact">
                        <div class="form-group">
                            <input type="text" id="subject" name="subject" placeholder="Subject" class="form-input">
                            <span class="error" id="subject-error"></span>
                        </div>
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="10" placeholder="Your Message" class="form-input"></textarea>
                            <span class="error" id="body-error"></span>
                        </div>
                        <input type="submit" value="SEND FEEDBACK" class="btn btn-secondary">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('../components/footer.php'); ?>
</body>
</html>