<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<div class="container pt-5">
    <a class="btn btn-danger btn-sm float-right" href="<?php asset('/logout') ?>">Logout</a>
    <h1 class="font-weight-light">Küche - <?php echo \App\Auth::name() ?></h1>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <div class="placeholder-paragraph"></div>
            <div class="placeholder-paragraph"></div>
        </div>
        <div class="col-md-4">
            <div class="placeholder-image"></div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
