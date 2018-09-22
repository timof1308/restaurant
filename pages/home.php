<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<section>
    <video autoplay muted loop id="videoIntro">
        <source src="<?php asset('/img/bar_counter.mp4') ?>" type="video/mp4">
    </video>

    <div id="overlay">
        <div class="section">
            <h1>Restaurant Name</h1>
            <div class="line"></div>
            <p class="lead">Willkommen auf unserer Webseite</p>
            <p>Bestellen Sie hier einfach und bequem Ihr Essen</p>
            <a href="#" id="anchor"><i class="fas fa-angle-double-down"></i></a>
        </div>
    </div>
</section>

<div class="pt-5" id="steps">
    <div class="container">
        <h1>So einfach gehts:</h1>
        <hr>

    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
