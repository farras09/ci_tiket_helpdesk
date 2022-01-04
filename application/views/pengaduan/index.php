   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Pengaduan
                   </h4>
               </div>
               <div class="col-auto">
                   <a href="<?= base_url('pengaduan/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                       <span class="icon">
                           <i class="fa fa-plus"></i>
                       </span>
                       <span class="text">
                           Tambah Pengaduan
                       </span>
                   </a>
               </div>
           </div>
       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th>No.</th>
                           <th>Kode Tiket</th>
                           <th>Tanggal Pengaduan</th>
                           <th>Uraian Pengaduan</th>
                           <th>Status</th>
                           <th>Aksi</th>
                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if ($pengaduan) :
                            foreach ($pengaduan as $data) :
                        ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $data['pgd_id']; ?></td>
                                   <td><?= $data['pgd_tgl_pengaduan']; ?></td>
                                   <td><?= $data['pgd_uraian_pengaduan']; ?></td>
                                   <td> <?= $data['pgd_adm_status'];?> oleh admin</td>
                                   <td>
                                   <a href="<?= base_url('pengaduan/detailTracking/') . $data['pgd_id']; ?>" class="btn btn-success btn-circle btn-sm"><i class="fa fa-tasks"></i></a>
                                   </td>
                                 
                                 
                               </tr>
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