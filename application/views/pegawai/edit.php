<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Pegawai
                        </h4>
                    </div>
                    <?php if (isAdmin())    : ?>
                        <div class="col-auto">
                            <a href="<?= base_url('pegawai') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open_multipart($action, [], ['pg_nip' => $pegawai['pg_nip']]); ?>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama">Nama</label>
                            <div class="col-md-9">
                                <input type="text" value="<?= set_value('pg_nama', $pegawai['pg_nama']); ?>" name="pg_nama" class="form-control" id="nama" placeholder="Nama...">
                                <?= form_error('pg_nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama">NIP</label>
                            <div class="col-md-9">
                                <input type="text" value="<?= set_value('pg_nip', $pegawai['pg_nip']); ?>" readonly name="pg_nip" class="form-control" id="nama" placeholder="NIP...">
                                <?= form_error('pg_nip', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="email">Email</label>
                            <div class="col-md-9">
                                <input type="text" name="pg_email" value="<?= set_value('pg_email', $pegawai['pg_email']); ?>"  class="form-control" id="email" placeholder="Input Email...">
                                <?= form_error('pg_email', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="no_hp">No HP</label>
                            <div class="col-md-9">
                                <input type="text" name="pg_no_hp" value="<?= set_value('pg_no_hp', $pegawai['pg_no_hp']); ?>" class="form-control" id="no_hp" placeholder="Input Nomor HP...">
                                <?= form_error('pg_no_hp', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>



                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="bidang">Bidang</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select name="pg_bdg_id" id="bidang" class="custom-select">
                                        <option value="" selected disabled>Pilih Bidang</option>

                                     
                                        <?php foreach ($bidang as $data) : ?>
                                            <option <?= $pegawai['pg_bdg_id'] == $data['bd_id'] ? 'selected' : ''; ?> value="<?= $data['bd_id'] ?>"><?= $data['bd_nama_bidang'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('bidang/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div> -->
                                </div>
                                <?= form_error('pg_bdg_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="file">Upload Foto</label>
                            <div class="col-md-9">
                                <input type="file" name="file" id="file" class="form-control" placeholder="Pilih file...">
                                <?= form_error('file', '<small class="text-danger">', '</small>'); ?>
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