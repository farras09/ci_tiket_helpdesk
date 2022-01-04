<?php
error_reporting(0);?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Status Tracking
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('tracking/index/'.$id) ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open($action, [], ['trck_pgd_id' => $id]); ?>
                
                <input value="<?= set_value('trck_id', $tracking['trck_id']!=''?$tracking['trck_id']:''); ?>" name="trck_id" id="bidang" type="hidden" class="form-control" placeholder="Progress Pengaduan...">

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="bidang">Progress Pengaduan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('trck_status', $tracking['trck_status']!=''?$tracking['trck_status']:''); ?>" name="trck_status" id="bidang" type="text" class="form-control" placeholder="Progress Pengaduan...">
                        <?= form_error('trck_status', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="bidang">Keterangan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('trck_keterangan',$tracking['trck_keterangan']!=''?$tracking['trck_keterangan']:''); ?>" name="trck_keterangan" id="bidang" type="text" class="form-control" placeholder="Keterangan...">
                        <?= form_error('trck_keterangan', '<small class="text-danger">', '</small>'); ?>
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

        </div>
    </div>
</div>