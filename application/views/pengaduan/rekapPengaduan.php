   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Pengaduan Masuk
                   </h4>
               </div>
           </div>
       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th>ID Laporan</th>
                           <th>Nama Pegawai</th>
                           <th>Uraian Pengaduan</th>
                           <th>Bidang</th>
                           <th>Tanggal Pengaduan</th>
                           <th>Status Perbaikan</th>
                           <?php if (isBagianUmum()) : ?>
                               <th>Perkiraan Perbaikan</th>
                           <?php endif; ?>
                           <th>Status Pengaduan</th>
                           

                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if ($data_pengaduan) :
                            foreach ($data_pengaduan as $data) :
                                if (isAdmin()) :

                        ?>
                                   <tr>
                                       <td><?= $data['pgd_id']; ?></td>
                                       <td><?= $data['pg_nama']; ?></td>
                                       <td><?= $data['pgd_uraian_pengaduan']; ?></td>
                                       <td><?= $data['bd_nama_bidang']; ?></td>
                                       
                                       <td><?= $data['pgd_biaya_perbaikan'] == 1 ? "Ada" : "Tidak Ada"; ?></td>
                                       <td>
                                           <?php
                                            if ($data['pgd_umum_status'] == 'Diterima') { ?>
                                               <label class="badge badge-success">Diterima</label>
                                           <?php
                                            } elseif ($data['pgd_umum_status'] == 'Ditunda') { ?>
                                               <label class="badge badge-danger">Ditunda</label>
                                               <p><?= $data['pgd_umum_keterangan']; ?></p>
                                           <?php } ?>


                                       </td>
                                       <td>
                                           <a href="<?= base_url('pengaduan/editPengaduan/') . $data['pgd_id']; ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                           <a href="<?= base_url('tracking/index/') . $data['pgd_id']; ?>" class="btn btn-success btn-circle btn-sm"><i class="fa fa-tasks"></i></a>
                                       </td>

                                   </tr>

                               <?php

                                else :  ?>
                                   <tr>
                                       <td><?= $data['pgd_id']; ?></td>
                                       <td><?= $data['pg_nama']; ?></td>
                                       <td><?= $data['pgd_uraian_pengaduan']; ?></td>
                                       <td><?= $data['bd_nama_bidang']; ?></td>
                                       <td><?= $data['pgd_tgl_pengaduan']; ?></td>
                                       <td><?= $data['pgd_biaya_perbaikan'] == 1 ? "Ada Biaya" : "Tidak Ada"; ?></td>
                                       <?php if (isBagianUmum()) : ?>
                                           <td><?= $data['pgd_adm_keterangan']; ?></td>

                                       <?php endif; ?>
                                       <td>
                                           <?php
                                            if ($data['pgd_umum_status'] == 'Diterima') { ?>
                                               <label class="badge badge-success">Diterima</label>
                                           <?php
                                            } elseif ($data['pgd_umum_status'] == 'Ditunda') { ?>
                                               <label class="badge badge-danger">Ditunda</label>
                                           <?php } ?>


                                       </td>
                                   </tr>

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