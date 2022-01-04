<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-7 col-md-2 py-2">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <!-- Outer Row -->
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <img class="img img-fluid mb-3" width="110px" src="<?= base_url(); ?>assets/images/login.png">
                            <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                            <!-- <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1> -->
                            <?= validation_errors(); ?>
                        </div>
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('', ['class' => 'user']); ?>
                        <div class="form-group">
                            <input type="text" name="usr_username" class="form-control form-control-user" placeholder="Username...">
                        </div>
                        <div class="form-group">
                            <input type="password" name="usr_password" class="form-control form-control-user" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                        <a href="<?= site_url('auth/form_pegawai'); ?>" class="btn btn-warning btn-user btn-block">Login Sebagai Pegawai</a>
                        <?= form_close(); ?>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>