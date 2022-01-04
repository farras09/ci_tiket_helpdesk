<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit User
                        </h4>
                    </div>
                    <?php if (isAdmin()) : ?>

                        <div class="col-auto">
                            <a href="<?= base_url('user') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-arrow-left"></i>
                                </span>
                                <span class="text">
                                    Kembali
                                </span>
                            </a>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open_multipart($action, [], ['usr_id' => $user['usr_id']]); ?>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama">Username</label>
                            <div class="col-md-9">
                                <input type="text" value="<?= set_value('usr_username', $user['usr_username']); ?>" name="usr_username" class="form-control" id="nama" placeholder="Input Username...">
                                <?= form_error('usr_username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nip">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="usr_password" class="form-control" id="nama" placeholder="Isi password jika ingin mengganti password...">
                                <?= form_error('usr_password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <?php
                        $status = array('Administrator', 'Bagian Umum', 'Teknisi IT');
                        ?>
                        <?php if (isAdmin()) : ?>
                            <div class="row form-group">
                                <label class="col-md-3 text-md-right" for="jabatan">Role</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select name="usr_role" id="jabatan" class="custom-select">
                                            <option value="" selected disabled>Pilih Role</option>
                                            <?php foreach ($status as $f) : ?>
                                                <option <?= $user['usr_role'] == $f ? 'selected' : ''; ?> value="<?= $f; ?>"><?= $f ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <?= form_error('usr_role', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama">Nama</label>
                            <div class="col-md-9">
                                <input type="text" value="<?= set_value('usr_nama', $user['usr_nama']); ?>" name="usr_nama" class="form-control" id="nama" placeholder="Input Nama...">
                                <?= form_error('usr_nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="alamat">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="usr_alamat" id="  " class="form-control" placeholder="Alamat..."><?= set_value('usr_alamat', $user['usr_alamat']); ?></textarea>
                                <?= form_error('usr_alamat', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="email">Email</label>
                            <div class="col-md-9">
                                <textarea name="usr_email" id="email" class="form-control" placeholder="Email..."><?= set_value('usr_email', $user['usr_email']); ?></textarea>
                                <?= form_error('usr_email', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="no_hp">No HP</label>
                            <div class="col-md-9">
                                <input type="text" name="usr_no_hp" class="form-control" value="<?= set_value('usr_no_hp', $user['usr_no_hp']); ?>" id="no_hp" placeholder="Input Nomor HP...">
                                <?= form_error('usr_no_hp', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-12 offset-md-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</bu>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>