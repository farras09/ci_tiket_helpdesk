   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Golongan
                   </h4>
               </div>
               <div class="col-auto">
                   <a href="<?= base_url('golongan/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                       <span class="icon">
                           <i class="fa fa-plus"></i>
                       </span>
                       <span class="text">
                           Tambah Golongan
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
                           <th>Golongan</th>
                           <th>Aksi</th>
                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if ($golongan) :
                            foreach ($golongan as $j) :
                        ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $j['golongan']; ?></td>
                                   
                                   <td>
                                       <a href="<?= base_url('golongan/edit/') . $j['id'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                       <a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url('golongan/delete/') . $j['id'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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