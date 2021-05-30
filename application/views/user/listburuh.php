<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <center><?= $this->session->flashdata('message'); ?></center>
            <!-- tombol modal -->
            <button type="button" class="btn btn-success mb-3 mt-3 px-4" data-toggle="modal" data-target="#modalTambah">
                Tambah
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Bonus</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($buruhlist as $u) : ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['posisi']; ?></td>
                            <td><?= $u['bonus']; ?>%</td>
                            <td colspan="2">
                                <center>
                                    <!-- tombol modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit<?= $u['id']; ?>">
                                        Edit
                                    </button>
                                    <!-- isi modal -->
                                    <div class="modal fade" id="modalEdit<?= $u['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Data Buruh</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form class="user" method="POST" action="<?= base_url('user/updateburuh/') ?><?= $u['id']; ?>">
                                                        <input type="hidden" name="id" id="id" value="<?= $u['id']; ?>">
                                                        <input type="hidden" name="bonus" id="bonus" value="<?= $u['bonus']; ?>">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Full Name" value="<?= $u['nama']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-user" id="posisi" name="posisi" placeholder="Posisi Buruh" value="<?= $u['posisi']; ?>" required>
                                                        </div>
                                                        <small>Untuk data bonus silahkan update di halaman beranda</small>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="" class="btn btn-danger"><a onclick="return confirm('Are you sure you want to delete this item?');" href="<?= base_url('user/deleteburuh/') ?><?= $u['id'] ?>" class="text-white"> Delete </a></button>
                                </center>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- isi modal -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Buruh</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="user" method="POST" action="<?= base_url('user/regisburuh/') ?>">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="posisi" name="posisi" placeholder="Posisi Buruh" required>
                    </div>
                    <small>Untuk data bonus silahkan nanti update di halaman beranda</small>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>