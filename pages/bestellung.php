<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<div class="container pt-5">
    <h5 class="mb-0 font-weight-normal"><?php translate('order.step') ?></h5>
    <h1><?php translate('order.heading') ?></h1>
    <hr>
    <p class="text-muted"><?php translate('order.sub') ?></p>
    <div class="d-flex flex-wrap justify-content-around" id="tables_list">
        <?php
        foreach ($tables as $table) {
            echo '
                <div class="p-3 flex-fill">
                    <div class="card" data-id="' . $table['id'] . '">
                        <div class="card-body">
                            <div class="sub">';
            translate("order.table");
            echo '</div >
                        <div class="heading">' . $table['id'] . '</div>
                        </div >
                    </div >
                </div >';
        }
        ?>

    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
