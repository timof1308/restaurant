<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<div class="container pt-5">

    <table class="table table-borderless res_table <?php echo $table['ausrichtung']; ?>"
           data-id="<?php echo $table['id'] ?>">
        <tbody>
        <?php if ($table['ausrichtung'] == "hor"): ?>
            <tr>
                <?php for ($i = 1; $i <= $table['plaetze'] / 2; $i++): ?>
                    <td>
                        <label class="place">
                            <input type="checkbox" data-nr="<?php echo $i ?>">
                            <span class="seat"></span>
                        </label>
                    </td>
                <?php endfor; ?>
            </tr>
            <tr>
                <?php for ($i = 0; $i < $table['plaetze'] / 2; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            </tr>
            <tr>
                <?php for ($i = ($table['plaetze'] / 2) + 1; $i <= $table['plaetze']; $i++): ?>
                    <td>
                        <label class="place">
                            <input type="checkbox" data-nr="<?php echo $i ?>">
                            <span class="seat"></span>
                        </label>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php else: ?>
            <?php $i = 1;
            while ($i <= $table['plaetze']): ?>
                <tr>
                    <td>
                        <label class="place">
                            <input type="checkbox" data-nr="<?php echo $i++ ?>">
                            <span class="seat"></span>
                        </label>
                    </td>
                    <td></td>
                    <td>
                        <label class="place">
                            <input type="checkbox" data-nr="<?php echo $i++ ?>">
                            <span class="seat"></span>
                        </label>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<!-- DRINKS -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="gerichte_modal_drinks"
     aria-hidden="true" id="gerichte_modal_drinks" data-keyboard="false" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php translate('order.drinks') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--
                <div class="d-flex">
                    <div class="col-md-6 align-self-center">
                        <div class="form-check d-flex">
                            <input class="form-check-input align-self-center" type="checkbox" name="" value="" id="dish_checkbox_">
                            <label class="form-check-label" for="dish_checkbox_">Name
                                <div class="text-muted extra">
                                    Beschreibung
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">3€</div>
                    <div class="col-md-4 align-self-center"></div>
                </div>
                -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary ml-auto next"><?php translate('order.next') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- STARTER -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="gerichte_modal_starter"
     aria-hidden="true" id="gerichte_modal_starter" data-keyboard="false" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php translate('order.starter') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary prev"><?php translate('order.prev') ?></button>
                <button class="btn btn-primary ml-auto next"><?php translate('order.next') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- MAIN COURSE -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="gerichte_modal_main"
     aria-hidden="true" id="gerichte_modal_main" data-keyboard="false" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php translate('order.main') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary prev"><?php translate('order.prev') ?></button>
                <button class="btn btn-primary ml-auto next"><?php translate('order.next') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- DESERT -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="gerichte_modal_desert"
     aria-hidden="true" id="gerichte_modal_desert" data-keyboard="false" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php translate('order.desert') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary prev"><?php translate('order.prev') ?></button>
                <button class="btn btn-primary ml-auto send"><?php translate('order.send') ?></button>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
