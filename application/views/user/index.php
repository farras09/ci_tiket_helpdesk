   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Admin
                   </h4>
               </div>
               <div class="col-auto">
                   <a href="<?= base_url('user/add'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                       <span class="icon">
                           <i class="fa fa-plus"></i>
                       </span>
                       <span class="text">
                           Tambah User
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
                           <th>Username</th>
                           <th>Role</th>
                           <th>Nama</th>
                           <th>Alamat</th>
                           <th>Email</th>
                           <th>Nomor HP</th>
                           <th>Aksi</th>
                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if ($user) :
                            foreach ($user as $m) :
                        ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $m['usr_username']; ?></td>
                                   <td><?= $m['usr_role']; ?></td>
                                   <td><?= $m['usr_nama']; ?></td>
                                   <td><?= $m['usr_alamat']; ?></td>
                                   <td><?= $m['usr_email']; ?></td>
                                   <td><?= $m['usr_no_hp']; ?></td>
                                   <td>
                                       <a href="<?= base_url('user/edit/') . $m['usr_id'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                       <a onclick="return confirm('Yakin ingin hapus user?')" href="<?= base_url('user/delete/') . $m['usr_id'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                   </td>
                                   
                               </tr>
                           <?php endforeach; ?>
                       <?php else : ?>
                           <td colspan="9" class="text-center">
                               Data Kosong
                           </td>
                       <?php endif; ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>