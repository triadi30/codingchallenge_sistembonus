<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($userlist as $u) : ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $u['name']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td><button type="" class="btn btn-danger"><a onclick="return confirm('Are you sure you want to delete this item?');" href="<?= base_url('user/deleteuser/') ?><?= $u['id'] ?>" class="text-white"> Delete </a></button></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>