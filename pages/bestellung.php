<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<div class="container pt-5">

    <div class="alert alert-danger mb-4" role="alert" id="orderAlert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading"><i class="fab fa-gripfire"></i>
            <?php translate('order.submit_error_title') ?> <i class="fab fa-gripfire"></i>
        </h4>
        <p class="mb-0">
            <?php translate('order.submit_error_1') ?>
            <span class="font-weight-bold">X</span>
            <?php translate('order.submit_error_2') ?>
        </p>
    </div>
    <div class="alert alert-success mb-4" role="alert" id="orderSuccess">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="alert-heading mb-0"><?php translate('order.submitted') ?></h5>
    </div>
    <div class="alert alert-success mb-4" role="alert" id="callSubmit">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="alert-heading mb-0"><?php translate('order.called') ?></h5>
    </div>

    <div class="text-right mb-3">
        <button class="btn btn-secondary callWaiterBtn mt-1"><i class="fas fa-bullhorn"></i> <?php translate('order.call') ?>
        </button>
        <button class="btn btn-secondary goPayingBtn mt-1"><i
                    class="fas fa-hand-holding-usd"></i> <?php translate('order.pay') ?></button>
    </div>

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
                <nav class="nav nav-pills nav-justified" id="modalTab" role="tablist">
                    <a class="nav-item nav-link active" id="menu-tab" data-toggle="tab" href="#menuDrinks" role="tab"
                       aria-controls="menu" aria-selected="true"><?php translate('order.menu') ?></a>
                    <a class="nav-item nav-link" id="order-tab" data-toggle="tab" href="#orderDrinks" role="tab"
                       aria-controls="order" aria-selected="false"><?php translate('order.order') ?></a>
                </nav>
                <div class="tab-content mt-4" id="modalTabContent">
                    <div class="tab-pane fade show active" id="menuDrinks" role="tabpanel" aria-labelledby="menu-tab">

                    </div>
                    <div class="tab-pane fade" id="orderDrinks" role="tabpanel" aria-labelledby="order-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php translate('order.name') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
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
                <nav class="nav nav-pills nav-justified" id="modalTab" role="tablist">
                    <a class="nav-item nav-link active" id="menu-tab" data-toggle="tab" href="#menuStarter" role="tab"
                       aria-controls="menu" aria-selected="true"><?php translate('order.menu') ?></a>
                    <a class="nav-item nav-link" id="order-tab" data-toggle="tab" href="#orderStarter" role="tab"
                       aria-controls="order" aria-selected="false"><?php translate('order.order') ?></a>
                </nav>
                <div class="tab-content mt-4" id="modalTabContent">
                    <div class="tab-pane fade show active" id="menuStarter" role="tabpanel" aria-labelledby="menu-tab">

                    </div>
                    <div class="tab-pane fade" id="orderStarter" role="tabpanel" aria-labelledby="order-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php translate('order.name') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
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
                <nav class="nav nav-pills nav-justified" id="modalTab" role="tablist">
                    <a class="nav-item nav-link active" id="menu-tab" data-toggle="tab" href="#menuMain" role="tab"
                       aria-controls="menu" aria-selected="true"><?php translate('order.menu') ?></a>
                    <a class="nav-item nav-link" id="order-tab" data-toggle="tab" href="#orderMain" role="tab"
                       aria-controls="order" aria-selected="false"><?php translate('order.order') ?></a>
                </nav>
                <div class="tab-content mt-4" id="modalTabContent">
                    <div class="tab-pane fade show active" id="menuMain" role="tabpanel" aria-labelledby="menu-tab">

                    </div>
                    <div class="tab-pane fade" id="orderMain" role="tabpanel" aria-labelledby="order-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php translate('order.name') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
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
                <nav class="nav nav-pills nav-justified" id="modalTab" role="tablist">
                    <a class="nav-item nav-link active" id="menu-tab" data-toggle="tab" href="#menuDesert" role="tab"
                       aria-controls="menu" aria-selected="true"><?php translate('order.menu') ?></a>
                    <a class="nav-item nav-link" id="order-tab" data-toggle="tab" href="#orderDesert" role="tab"
                       aria-controls="order" aria-selected="false"><?php translate('order.order') ?></a>
                </nav>
                <div class="tab-content mt-4" id="modalTabContent">
                    <div class="tab-pane fade show active" id="menuDesert" role="tabpanel" aria-labelledby="menu-tab">

                    </div>
                    <div class="tab-pane fade" id="orderDesert" role="tabpanel" aria-labelledby="order-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php translate('order.name') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary prev"><?php translate('order.prev') ?></button>
                <button class="btn btn-primary ml-auto send"><?php translate('order.send') ?></button>
            </div>
        </div>
    </div>
</div>

<div style="display: none;" class="helper" data-comment="<?php translate('order.comment') ?>"></div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
