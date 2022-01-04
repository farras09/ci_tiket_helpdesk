   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Pegawai
                   </h4>
               </div>
               <div class="col-auto">
                   <a href="<?= site_url('pegawai/add'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                       <span class="icon">
                           <i class="fa fa-plus"></i>
                       </span>
                       <span class="text">
                           Tambah Pegawai
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
                           <th>NIP</th>
                           <th>Nama</th>
                           <th>Email</th>
                           <th>No. HP</th>
                           <th>Bidang</th>
                           <th>Foto</th>
                           <th>Aksi</th>
                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if ($pegawai) :
                            foreach ($pegawai as $m) :
                        ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $m['pg_nip']; ?></td>
                                   <td><?= $m['pg_nama']; ?></td>
                                   <td><?= $m['pg_email']; ?></td>
                                   <td><?= $m['pg_no_hp']; ?></td>
                                   <td><?= $m['bd_nama_bidang']; ?></td>
                                   <td><img src="<?= base_url(); ?>assets/files/<?= $m['pg_foto']; ?>" style="width: 80%;" alt="" srcset=""></td>

                                   <td>
                                       <a href="<?= base_url('pegawai/edit/') . $m['pg_nip'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                       <a onclick="return confirm('Yakin ingin hapus pegawai?')" href="<?= base_url('pegawai/delete/') . $m['pg_nip'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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