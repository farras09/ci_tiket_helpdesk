<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Kategori Soal
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('kategori') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kategori">kategori</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('category'); ?>" name="category" id="kategori" type="text" class="form-control" placeholder="kategori...">
                        <?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</bu>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>