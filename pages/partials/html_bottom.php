<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php asset('/js/jquery-3_3_1.min.js') ?>"></script>
<script src="<?php asset('/js/popper.min.js') ?>"></script>
<script src="<?php asset('/js/bootstrap.min.js') ?>"></script>
<!-- Optional JavaScript -->
<script src="<?php asset('/js/ApiClient.js') ?>"></script>
<script src="<?php asset('/js/app.js') ?>"></script>

<?php
if (isset($_SESSION['flash'])) {
    echo '<script>toast("' . $_SESSION['flash']['data'] . '", "' . $_SESSION['flash']['status'] . '")</script>';
    unset($_SESSION['flash']);
}
?>

</body>
</html>
