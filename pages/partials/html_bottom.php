<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- Optional JavaScript -->
<script src="<?php asset('/js/app.js') ?>"></script>

<?php
if (isset($_SESSION['flash'])) {
    echo '<script>toast("' . $_SESSION['flash']['data'] . '", "' . $_SESSION['flash']['status'] . '")</script>';
    unset($_SESSION['flash']);
}
?>

</body>
</html>
