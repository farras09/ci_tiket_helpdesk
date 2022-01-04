<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            <?= $title;?>
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('pengaduan/dataPengaduan') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open($action, [], ['pgd_id' => $data_pengaduan['pgd_id']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="file">NIP</label>
                    <div class="col-md-9">
                        <input type="text" readonly name="pgd_pg_nip" class="form-control" value="<?= set_value('pgd_pg_nip',$data_pengaduan['pgd_pg_nip']);?>" >
                        <?= form_error('file', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="file">Nama</label>
                    <div class="col-md-9">
                        <input type="text" readonly name="pg_nama" class="form-control" value="<?= set_value('pg_nama',$data_pengaduan['pg_nama']);?>" >
                        <?= form_error('pg_nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="file">Bidang</label>
                    <div class="col-md-9">
                        <input type="text" readonly name="bd_nama_bidang" class="form-control" value="<?= set_value('bd_nama_bidang',$data_pengaduan['bd_nama_bidang']);?>" >
                        <?= form_error('bd_nama_bidang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    
                    <?php 
                    $biaya_perbaikan = [0=>'Tidak Ada',1=>'Ada']; ?>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="pengajuan">Biaya Perbaikan</label>
                            <div class="col-md-9">

                                <select name="pgd_biaya_perbaikan" id="status_perbaikan" class="custom-select">
                                    
                                    <?php foreach ($biaya_perbaikan as $key=>$val) : ?>
                                        <option <?= $data_pengaduan['pgd_biaya_perbaikan'] == $key ? 'selected' : '' ?> value="<?= $key; ?>"><?= $val ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('pgd_biaya_perbaikan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="keterangan">Uraian</label>
                            <div class="col-md-9">
                                <textarea class="form-control" readonly name="pgd_uraian_pengaduan" id="" cols="30" rows="10"><?= $data_pengaduan['pgd_uraian_pengaduan']; ?></textarea>
                                <?= form_error('pgd_uraian_pengaduan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group"><label class="col-md-3 text-md-right" for="keterangan">Perkiraan Perbaikan</label><div class="col-md-9"><textarea class="form-control" name="pgd_adm_keterangan" id="" cols="30" rows="10"><?= $data_pengaduan['pgd_adm_keterangan']!==""?$data_pengaduan['pgd_adm_keterangan']:""; ?></textarea><?= form_error('pgd_adm_keterangan', '<small class="text-danger">', '</small>'); ?></div></div>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="file">Upload Berkas Pendukung (opsional)</label>
                    <div class="col-md-9">
                        <input type="file" name="file" id="file" class="form-control" placeholder="Pilih file...">
                        <?= form_error('file', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div> -->
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</bu>
                    </div>
                </div>
            </div>

        </div>
        <?= form_close(); ?>
    </div>
