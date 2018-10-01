<?php include "partials/html_top.php"; ?>

<?php include 'partials/navbar.php'; ?>

<div class="container pt-5">
    <a class="btn btn-danger btn-sm float-right" href="<?php asset('/logout') ?>">Logout</a>
    <h1 class="font-weight-light">Küche - <?php echo \App\Auth::name() ?></h1>
    <hr>
</div>
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-around align-self-center" id="">
        <?php foreach ($tables as $table): ?>
            <div class="p-3 flex-fill align-self-center">
                <div class="card">
                    <div class="card-header">
                        Tisch <?php echo $table['id'] ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless res_table <?php echo $table['ausrichtung']; ?>"
                               data-id="<?php $table['id'] ?>">
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
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/html_bottom.php'; ?>
