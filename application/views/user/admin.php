<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-1 mb-4 py-0"><i class="fa fa-bars"></i><small class="font-weight-bold">
            <b>
                <>
            </b>
        </small></button>

    <!-- Demo content -->
    <h2 class="display-4 text-white">Sistem Pembagian Bonus</h2>
    <p class="lead text-white mb-0">Sistem ini akan secara otomatis melakukan pembagian bonus berdasarkan presentase</p>

    <div class="separator"></div>
    <div class="row text-white">
        <div class="col-lg-6">
            <form method="POST" action="<?= base_url('user/update_pembayaran') ?>">
                <?= $this->session->flashdata('message'); ?>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Pembayaran</label>
                    <div class="col-sm-5 ml-3">
                        <input type="text" class="form-control-plaintext text-center" name="pembayaran" value="<?= $pembayaran; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="buruh" class="col-sm-2 col-form-label"><?= $buruh1['nama']; ?></label>
                    <div class="col-sm-5 ml-3">
                        <input type="text" class="form-control text-center" name="buruhA" id="buruhA" placeholder="Persentase Bonus" value="<?= $buruhA; ?>">
                    </div>
                    <div class="col-sm-3">%</div>
                </div>
                <div class="form-group row">
                    <label for="buruh" class="col-sm-2 col-form-label"><?= $buruh2['nama']; ?></label>
                    <div class="col-sm-5 ml-3">
                        <input type="text" class="form-control text-center" name="buruhB" id="buruhB" placeholder="Persentase Bonus" value="<?= $buruhB; ?>">
                    </div>
                    <div class="col-sm-3">%</div>
                </div>
                <div class="form-group row">
                    <label for="buruh" class="col-sm-2 col-form-label"><?= $buruh3['nama']; ?></label>
                    <div class="col-sm-5 ml-3">
                        <input type="text" class="form-control text-center" name="buruhC" id="buruhC" placeholder="Persentase Bonus" value="<?= $buruhC; ?>">
                    </div>
                    <div class="col-sm-3">%</div>
                </div>
                <div class="form-group row">
                    <div for="buruh" class="col-sm-2 col-form-label"><button type="submit" class="btn btn-success">Save</button></div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="card text-white bg-success mb-3 mx-auto" style="max-width: 18rem;">
                <div class="card-header"><?= $buruh1['posisi']; ?></div>
                <div class="card-body">
                    <h5 class="card-title">Nama : <?= $buruh1['nama']; ?></h5>
                    <p class="card-text">
                        Bonus : <?= $bonus1 ?>
                    </p>
                </div>
            </div>
            <div class="card text-white bg-success mb-3 mx-auto" style="max-width: 18rem;">
                <div class="card-header"><?= $buruh2['posisi']; ?></div>
                <div class="card-body">
                    <h5 class="card-title">Nama : <?= $buruh2['nama']; ?></h5>
                    <p class="card-text">
                        Bonus : <?= $bonus2 ?>
                    </p>
                </div>
            </div>
            <div class="card text-white bg-success mb-3 mx-auto" style="max-width: 18rem;">
                <div class="card-header"><?= $buruh3['posisi']; ?></div>
                <div class="card-body">
                    <h5 class="card-title">Nama : <?= $buruh3['nama']; ?></h5>
                    <p class="card-text">
                        Bonus : <?= $bonus3 ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End demo content -->