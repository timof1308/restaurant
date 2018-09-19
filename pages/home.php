<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php asset('/css/app.css')?>">
    <title>Restaurant Bestellung</title>
</head>
<body>

<?php include 'partials/navbar.php' ?>

<div class="jumbotron" id="intro">
    <h1>Restaurant Name</h1>
    <p class="lead">Willkommen auf unserer Webseite</p>
    <hr class="my-4">
    <p>Bestellen Sie hier ihr essen einfach und bequem Ihr Essen</p>
    <a class="btn btn-primary btn-lg" href="<?php asset('/bestellung')?>" role="button">Los Gehts!</a>
</div>

<?php include 'partials/footer.php' ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="<?php asset('/js/app.js')?>"></script>
</body>
</html>
