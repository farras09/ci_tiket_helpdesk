<?php 
error_reporting(0);
?>
<!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Pengaduan Masuk
                   </h4>
                   <div class="my-2"></div>
                   <?php if (isAdmin()) : ?>
                       <a class="btn btn-primary btn-icon-split" target="__blank" href="<?php echo $url_cetak; ?>">
                           <span class="icon text-white-50">
                               <i class="fas fa-print"></i>
                           </span>
                           <span class="text">Cetak Data</span>
                       </a>

                       <!-- <a class="btn btn-success btn-icon-split" target="__blank" href="<?php echo $url_export; ?>">
                           <span class="icon text-white-50">
                               <i class="fas fa-file-excel"></i>
                           </span>
                           <span class="text">Export</span>
                       </a> -->
                       <br><br>
                       <form action="" method="get">
                           <label>Pilih Berdasarkan</label>
                           <select name="filter" id="filter">
                               <option value="">Pilih</option>
                               <option value="1">Tanggal</option>
                               <option value="2">Bulan</option>
                               <option value="3">Tahun</option>
                           </select>


                           <div id="form-tanggal" style="display:inline-flex;">
                               <label>Tanggal</label>
                               <input type="text" autocomplete="off" name="tanggal" id="input-tanggal1">
                           </div>

                           <div id="form-bulan" style="display: inline-table;">
                               <label>Bulan</label>
                               <select name="bulan">
                               <option value="" selected>Pilih</option>
                                   <option value="1">Januari</option>
                                   <option value="2">Februari</option>
                                   <option value="3">Maret</option>
                                   <option value="4">April</option>
                                   <option value="5">Mei</option>
                                   <option value="6">Juni</option>
                                   <option value="7">Juli</option>
                                   <option value="8">Agustus</option>
                                   <option value="9">September</option>
                                   <option value="10">Oktober</option>
                                   <option value="11">November</option>
                                   <option value="12">Desember</option>
                               </select>
                           </div>

                           <div id="form-tahun" style="display: inline-table;">
                               <label>Tahun</label>
                               <select name="tahun">
                                   <option value="">Pilih</option>
                                   <?php
                                    foreach ($tahun as $data) {
                                    ?>
                                       <option value="<?php echo $data['year']; ?>"><?php echo $data['year']; ?></option>
                                   <?php }
                                    ?>
                               </select>
                           </div>
                           <br><br>
                           <button type="submit" class="btn btn-outline-primary" id="tampil">Tampilkan</button>
                           <a class="btn btn-outline-danger" href="<?php echo site_url('pengaduan/dataPengaduan'); ?>">Reset</a>
                       </form>
                       <hr>
                       <h4><?php echo $keterangan; ?></h4>
               </div>
           <?php endif; ?>
           </div>

       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th>ID Laporan</th>
                           <th>Tanggal Pengaduan</th>
                           <th>Nama Pegawai</th>
                           <th>Uraian Pengaduan</th>
                           <th>Bidang</th>
                           <th>Keterangan Perbaikan</th>
                           <?php if (isTeknisi()) : ?>
                               <th>Status Perbaikan</th>
                           <?php endif; ?>
                           <?php if (!isTeknisi()) : ?>
                               <th>Status Perbaikan</th>
                               <th>Biaya Perbaikan</th>
                               <th>Teknisi</th>
                            
                               <th>Status Pengaduan</th>
                           <?php endif; ?>
                           <th>Aksi</th>

                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if (isset($data_pengaduan)) :
                            foreach ($data_pengaduan as $data) :
                                if (isAdmin()) :

                        ?>
                                   <tr>
                                       <td><?= $data['pgd_id']; ?></td>
                                       <td><?= $data['pgd_tgl_pengaduan']; ?></td>
                                       <td><?= $data['pg_nama']; ?></td>
                                       <td><?= $data['pgd_uraian_pengaduan']; ?></td>
                                       <td><?= $data['bd_nama_bidang']; ?></td>
                                       <td><?= $data['pgd_adm_keterangan']; ?></td>
                                       <td><?= $data['pgd_biaya_perbaikan'] == 1 ? "Ada" : "Tidak Ada"; ?></td>
                                       <td><?= rupiah($data['pgd_jumlah_biaya_perbaikan']); ?></td>
                                       <td><?= $data['pgd_teknisi']; ?></td>
                                       <td>
                                           <?php
                                            if ($data['pgd_umum_status'] == 'Diterima') { ?>
                                               <label class="badge badge-success">Diterima</label>
                                               <p><?= $data['pgd_umum_keterangan']; ?></p>
                                           <?php
                                            } elseif ($data['pgd_umum_status'] == 'Ditunda') { ?>
                                               <label class="badge badge-danger">Ditunda</label>
                                               <p><?= $data['pgd_umum_keterangan']; ?></p>
                                           <?php } ?>


                                       </td>

                                       <td>
                                           <a href="<?= base_url('pengaduan/editPengaduan/') . $data['pgd_id']; ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>

                                           <a href="<?= base_url('pengaduan/delete/') . $data['pgd_id']; ?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus pengaduan? Data akan dihapus permanen')"><i class="fa fa-trash"></i></a>
                                       </td>

                                   </tr>

                               <?php

                                elseif (isBagianUmum()) :  ?>
                                   <tr>
                                       <td><?= $data['pgd_id']; ?></td>
                                       <td><?= $data['pgd_tgl_pengaduan']; ?></td>
                                       <td><?= $data['pg_nama']; ?></td>
                                       <td><?= $data['pgd_uraian_pengaduan']; ?></td>
                                       <td><?= $data['bd_nama_bidang']; ?></td>
                                       <td><?= $data['pgd_biaya_perbaikan'] == 1 ? "Ada Biaya" : "Tidak Ada"; ?></td>

                                       <td><?= $data['pgd_adm_keterangan']; ?></td>
                                       <td><?= rupiah($data['pgd_jumlah_biaya_perbaikan']); ?></td>
                                       <td><?= $data['pgd_teknisi']; ?></td>
                                       <td>
                                           <?php
                                            if ($data['pgd_umum_status'] == 'Diterima') { ?>
                                               <label class="badge badge-success">Diterima</label>
                                           <?php
                                            } elseif ($data['pgd_umum_status'] == 'Ditunda') { ?>
                                               <label class="badge badge-danger">Ditunda</label>
                                           <?php } ?>
                                       </td>
                                       
                                       
                                       <td>

                                           <a href="<?= base_url('pengaduan/editPengaduan/') . $data['pgd_id']; ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                       </td>
                                   </tr>

                               <?php else : ?>
                                   <td><?= $data['pgd_id']; ?></td>
                                   <td><?= $data['pgd_tgl_pengaduan']; ?></td>
                                   <td><?= $data['pg_nama']; ?></td>
                                   <td><?= $data['pgd_uraian_pengaduan']; ?></td>
                                   <td><?= $data['bd_nama_bidang']; ?></td>
                                   <td><?= $data['pgd_adm_keterangan']; ?></td>
                                   <td><?= $data['pgd_teknisi_status']; ?></td>
                                   <td>
                                       <a href="<?= base_url('tracking/index/') . $data['pgd_id']; ?>" class="btn btn-success btn-circle btn-sm"><i class="fa fa-tasks"></i></a>
                                       <?php if ($data['pgd_teknisi_status'] == 'Belum Selesai') : ?>
                                           <a href="<?= base_url('pengaduan/editPengaduan/') . $data['pgd_id']; ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                       <?php endif; ?>
                                   </td>
                               <?php endif; ?>
                           <?php endforeach; ?>
                       <?php else : ?>
                           <td colspan="7" class="text-center">
                               Data Kosong
                           </td>
                       <?php endif; ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>