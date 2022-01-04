<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Pengaduan
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('pengaduan') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open($action, []); ?>
                <input type="hidden" name="tk_id" value="<?= set_value('tk_id', $kode) ?>" id="">
                <input type="hidden" name="pg_nip" value="<?= set_value('pg_nip', $this->session->userdata('login_session')['nip']); ?>" id="">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="keterangan">Uraian Pengaduan</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="tk_uraian" id="" cols="30" rows="10"></textarea>
                                <?= form_error('tk_uraian', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
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