<!-- <div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-auto">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Halaman Login Sistem Pembayaran Bonus</h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" method="POST" action="<?= base_url('auth') ?>">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email'); ?>" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="fixed-bottom text-white text-center">
            <span>Triadi Kurniawan - 2021</span>
        </div>
    </div>

</div> -->
<div class="pages">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 mx-auto mt-5">
                <h1 class="text-center login-title">Halaman Login Sistem Pembayaran Bonus</h1>
                <?= $this->session->flashdata('message'); ?>
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                    <form class="form-signin" method="POST" action="<?= base_url('auth') ?>">
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?= set_value('email'); ?>" autofocus>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom text-center">
        <span>Triadi Kurniawan - 2021</span>
    </div>
</div>