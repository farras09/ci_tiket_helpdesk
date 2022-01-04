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
                    <?php if (isAdmin()) : ?>
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
                <div class="col-md-2">
                
                <img src="<?= base_url();?>assets/files/<?= $pegawai['pg_foto'];?>" class="img img-thumbnail">
                </div>
                    <div class="col-md-5">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama">Nama</label>
                            <div class="col-md-9">
                                <input type="text" value="<?= set_value('pg_nama', $pegawai['pg_nama']); ?>" name="pg_nama" class="form-control" id="nama" placeholder="Nama...">
                                <?= form_error('pg_nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nip">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="pg_password" class="form-control" id="nama" placeholder="Isi password jika ingin mengganti password...">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama">NIP</label>
                            <div class="col-md-9">
                                <input type="text" value="<?= set_value('pg_nip', $pegawai['pg_nip']); ?>" readonly name="pg_nip" class="form-control" id="nama" placeholder="NIP...">
                                <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-5">

                        <!-- <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="unit_kerja">Unit Kerja</label>
                            <div class="col-md-9">
                                <textarea name="unit_kerja" id="" class="form-control" placeholder="Unit Kerja..."><?= set_value('unit_kerja', $pegawai['unit_kerja']); ?></textarea>
                                <?= form_error('unit_kerja', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div> -->
                      

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