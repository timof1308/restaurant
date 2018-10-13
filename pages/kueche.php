<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<div class="container pt-5">
    <h1 class="font-weight-light">
        <span>Küche - <?php echo \App\Auth::name() ?></span>
        <a class="btn btn-danger float-right logoutBtn" href="<?php asset('/logout') ?>">Logout</a>
    </h1>
    <hr>
</div>
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-around align-self-center">
        <?php foreach ($tables as $table): ?>
            <div class="p-3 flex-fill align-self-center">
                <div class="card">
                    <div class="card-header">
                        Tisch <?php echo $table['id'] ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless res_table <?php echo $table['ausrichtung']; ?>"
                               data-id="<?php echo $table['id'] ?>" data-seats="<?php echo $table['plaetze'] ?>" data-order="">
                            <tbody>
                            <?php if ($table['ausrichtung'] == "hor"): ?>
                                <tr>
                                    <?php for ($i = 1; $i <= $table['plaetze'] / 2; $i++): ?>
                                        <td>
                                            <label class="place">
                                                <input type="checkbox" data-nr="<?php echo $i ?>" data-toggle="popover">
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
                                                <input type="checkbox" data-nr="<?php echo $i ?>" data-toggle="popover">
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
                                                <input type="checkbox" data-nr="<?php echo $i++ ?>"
                                                       data-toggle="popover">
                                                <span class="seat"></span>
                                            </label>
                                        </td>
                                        <td></td>
                                        <td>
                                            <label class="place">
                                                <input type="checkbox" data-nr="<?php echo $i++ ?>"
                                                       data-toggle="popover">
                                                <span class="seat"></span>
                                            </label>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button class="btn btn-primary mt-4 openOrderModal">Bestellung</button>
                            <button class="btn btn-primary mt-4 viewBillBtn">Rechnung</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bestellung_modal"
     aria-hidden="true" id="bestellung_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Bestellung Tisch <span></span></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Kommentar</th>
                        <th>Platz</th>
                        <th>Hinzugefügt</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
