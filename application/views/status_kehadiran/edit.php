<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Status Kehadiran
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('status_kehadiran') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open($action, [],['id'=>$status_kehadiran['id']]); ?>
               
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="status_kehadiran">Status Kehadiran</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('status_kehadiran',$status_kehadiran['status_kehadiran']); ?>" name="status_kehadiran" id="status_kehadiran" type="text" class="form-control" placeholder="Input Status Kehadiran...">
                        <?= form_error('status_kehadiran', '<small class="text-danger">', '</small>'); ?>
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