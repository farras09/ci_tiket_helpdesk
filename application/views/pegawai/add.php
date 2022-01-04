<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Pegawai
                        </h4>
                    </div>
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
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open_multipart($action, []); ?>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama">Nama</label>
                            <div class="col-md-9">
                                <input type="text" name="pg_nama" class="form-control" id="nama" placeholder="Nama...">
                                <?= form_error('pg_nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nip">NIP</label>
                            <div class="col-md-9">
                                <input type="text" name="pg_nip" class="form-control" id="nama" placeholder="NIP...">
                                <?= form_error('pg_nip', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="email">Email</label>
                            <div class="col-md-9">
                                <input type="text" name="pg_email" class="form-control" id="email" placeholder="Input Email...">
                                <?= form_error('pg_email', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="no_hp">No HP</label>
                            <div class="col-md-9">
                                <input type="text" name="pg_no_hp" class="form-control" id="no_hp" placeholder="Input Nomor HP...">
                                <?= form_error('pg_no_hp', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <!-- <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nip">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" id="nama" placeholder="Isi password jika ingin mengganti password...">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div> -->
                        
                        
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="bidang">Bidang</label>
                            <div class="col-md-9">
                                <?php
                                // $kepala_dinas = array('Analisis Data Persuratan', 'Pengolah Data Persuratan', 'Operator Faximile/Caraka', 'Operator Faximile/Pramu Tamu');
                                // $sekretariat = array('Analis Data Kepegawaian', 'Penata Administrasi Kepegawaian', 'Pengelola Simpeg dan DUK');
                                // $bidang_pendataaan_arsip_dan_pengembangan_sistem = array('Analis Data Keuangan', 'Bendaha (Pengeluaran)', 'Bendahara (PNBP)', 'Pembuat Daftar Gaji', 'Pengolah Data Keuangan', 'Analisi Data SAKPA');
                                // $bidang_penyelenggaraan_pelayanan_perizinan_dan_non_perizinan = array('Analis Data BMN (Rumah tangga)', 'Analisi Data BMN (Perlengkapan)', 'Pengelola Kendaraan Dinas', 'Pengelola BMN (Inventaris)', 'Koordinator Satpam', 'Pengolah makanan', 'Pengelola BMN (persediaan)', 'Pemelihara Kebun Wanariset');
                                ?>
                                <div class="input-group">
                                    <select name="pg_bdg_id" id="bidang" class="custom-select">
                                        <option value="" selected disabled>Pilih Bidang</option>
    
                                        <!-- Kepala Dinas -->
                                        <!-- <optgroup value="" label="Kepala Dinas"></optgroup> -->
                                        <?php foreach ($bidang as $data) : ?>
                                            <option value="<?= $data['bd_id'] ?>"><?= $data['bd_nama_bidang'] ?></option>
                                        <?php endforeach; ?>
    
                                    </select>
                                    <!-- <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('jabatan/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div> -->
                                </div>
                                <?= form_error('pg_bdg_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="file">Upload Foto</label>
                            <div class="col-md-9">
                                <input type="file" name="pg_foto" id="file" class="form-control" placeholder="Pilih file...">
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