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
            <form>
                <?= $this->session->flashdata('message'); ?>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Pembayaran</label>
                    <div class="col-sm-5 ml-3">
                        <input type="text" class="form-control-plaintext text-center uang" name="pembayaran" value="<?= $pembayaran; ?>" disabled>
                    </div>
                    <div class="col-sm-3 mt-2">Rupiah</div>
                </div>

                <?php $no = 1;
                foreach ($buruh as $b) : ?>

                    <div class="form-group row">
                        <label for="buruh" class="col-sm-2 col-form-label"><?= $b['nama']; ?></label>
                        <div class="col-sm-5 ml-3">
                            <input type="text" class="form-control text-center" name="<?= $b['id']; ?>" id="<?= $b['id']; ?>" placeholder="Persentase Bonus" value="<?= $b['bonus']; ?>" disabled>
                        </div>
                        <div class="col-sm-3">%</div>
                    </div>

                <?php $no++;
                endforeach; ?>
            </form>
        </div>


        <div class="col-lg-6">
            <?php foreach ($buruh as $b) : ?>
                <div class="card text-white bg-success mb-3 mx-auto" style="max-width: 18rem;">
                    <div class="card-header"><?= $b['posisi']; ?></div>
                    <div class="card-body">
                        <h5 class="card-title">Nama : <?= $b['nama']; ?></h5>
                        <p class="card-text">
                            Bonus : Rp. <?= number_format($b['bonus'] / 100 * $pembayaran, 0, ".", "."); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>
<!-- End demo content -->