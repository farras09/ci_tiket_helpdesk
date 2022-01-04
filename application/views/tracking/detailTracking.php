   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Tracking 
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
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th>No.</th>
                           <th>Status</th>
                           <th>Keterangan</th>
                           
                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if ($tracking) :
                            foreach ($tracking as $data) :
                        ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $data['trck_status']; ?></td>
                                   <td><?= $data['trck_keterangan']; ?></td>
                                   
                                  
                               </tr>
                           <?php endforeach; ?>
                       <?php else : ?>
                           <td colspan="3" class="text-center">
                               Data Kosong
                           </td>
                       <?php endif; ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>