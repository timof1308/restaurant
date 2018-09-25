<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<section>
    <video autoplay preload="auto" muted loop id="videoIntro">
        <source src="<?php asset('/img/bar_counter.mp4') ?>" type="video/mp4">
    </video>

    <div id="overlay">
        <div class="section">
            <h1>Restaurant Name</h1>
            <div class="line"></div>
            <p class="lead"><?php translate('home.subtitle') ?></p>
            <p><?php translate('home.about') ?></p>
            <a href="#" id="anchor"><i class="fas fa-angle-double-down"></i></a>
        </div>
    </div>
</section>

<div class="pt-5" id="steps">
    <div class="container text-center">
        <h1 class="text-left"><?php translate('home.steps.heading') ?></h1>
        <hr>
        <div class="row mt-5 mb-5">
            <div class="col-md-4">
                <div class="icon">
                    <i class="far fa-hand-pointer"></i>
                </div>
                <div class="text">
                    <?php translate('home.steps.select') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="text">
                    <?php translate('home.steps.food') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon">
                    <i class="far fa-money-bill-alt"></i>
                </div>
                <div class="text">
                    <?php translate('home.steps.pay') ?>
                </div>
            </div>
        </div>
        <div class="text">
            <?php translate('home.steps.extra') ?>
        </div>
        <a href="<?php asset('/bestellung') ?>" class="mt-5 btn btn-primary btn-lg"><?php translate('home.steps.go') ?></a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
