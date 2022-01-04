<div class="row justify-content-center">

    <div class="col-xl-7 col-lg-5 col-md-2 py-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                            </div>
                            <?= $this->session->flashdata('pesan'); ?>
                            <?= form_open('', ['class' => 'user']); ?>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input autofocus="autofocus" autocomplete="off" name="nim" value="<?= set_value('nim'); ?>" type="text" class="form-control form-control-user" placeholder="NIM">
                                    <?= form_error('nim', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input autofocus="autofocus" name="nama" autocomplete="off" value="<?= set_value('nama'); ?>" type="text" class="form-control form-control-user" placeholder="Nama">
                                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <select name="fakultas_id" id="fakultas" class="custom-select">
                                        <option value="" selected disabled>Pilih Fakultas</option>
                                        <?php foreach ($fakultas as $f) : ?>
                                            <option <?= set_select('fakultas', $f['fakultas']) ?> value="<?= $f['id'] ?>"><?= $f['fakultas'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?= form_error('fakultas', '<small class="text-danger">', '</small>'); ?>
                                <div class="col-sm-6">
                                    <select name="jurusan_id" id="jurusan" class="custom-select">
                                        <option value="" selected disabled>Pilih Jurusan</option>
                                        <?php foreach ($jurusan as $j) : ?>
                                            <option <?= set_select('jurusan', $j['jurusan']) ?> value="<?= $j['id'] ?>"><?= $j['jurusan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?= form_error('jurusan', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <!-- <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                            <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div> -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" value="<?= set_value('alamat'); ?>" name="alamat" class="form-control form-control-user" placeholder="Alamat">
                                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-12">
                                    <input type="text" value="<?= set_value('no_hp'); ?>" placeholder="ex : 62812342122" name="no_hp" class="form-control form-control-user" placeholder="No HP">
                                    <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>