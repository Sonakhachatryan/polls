<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/partials/_head.php';?>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <section class="tm-section-intro">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="tm-wrapper-center">
                    <h1 class="tm-section-intro-title">Easy Polls</h1>
                    <p class="tm-section-intro-text">
                        Create polls is easy with us.
                    </p>
                    <a href="<?= url('login')?>" class="tm-btn-white-big">Login</a>
                    <p class="tm-section-intro-text mt20">Don't have an account? <a href="<?= url('register')?>">Click here to sign up</a></p>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include __DIR__ . '/partials/_footer.php';?>
</body>
</html>