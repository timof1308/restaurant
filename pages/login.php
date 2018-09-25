<?php include "partials/html_top.php"; ?>

<div id="login-page">
    <div class="card" id="login-card">
        <h3 class="card-header font-weight-normal mb-3 text-center">Login</h3>
        <div class="card-body">
            <?php
            if (isset($_SESSION['login'])) {
                unset($_SESSION['login']);
                echo '<div class="alert alert-danger" role="alert">';
                translate('login.error');
                echo '</div>';
            }
            ?>
            <form action="<?php asset('/login') ?>" method="POST" class="form-signin">
                <div class="form-group">
                    <label for="name"><?php translate('login.user') ?></label>
                    <input type="text" name="name" id="name" placeholder="<?php translate('login.user') ?>"
                           class="form-control" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password"><?php translate('login.pw') ?></label>
                    <input type="password" name="password" id="password" placeholder="<?php translate('login.pw') ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success btn-block mt-4"><i
                            class="fas fa-sign-in-alt"></i> <?php translate('login.submit') ?></button>
            </form>
        </div>
    </div>

</div>

<?php include 'partials/html_bottom.php'; ?>
