   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>

   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data rekap 
                   </h4>
               </div>
               <div class="col-auto">
                   <a href="<?= base_url('rekap/add') ?>" class="btn btn-sm btn-success btn-icon-split">
                       <span class="icon">
                           <i class="fa fa-print"></i>
                       </span>
                       <span class="text">
                           Cetak Data rekap
                       </span>
                   </a>
                   <a href="<?= base_url('mahasiswa') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                           <th>Nama</th>
                           <th>Jumlah Betul</th>
                           <th>Jumlah Salah</th>
                           <th>Skor</th>
                           <th>Status</th>
                           <th>Tanggal Tes</th>
                       </tr>
                   </thead>

                   <tbody>
                       <?php
                        $no = 1;
                        if ($rekap) :
                            foreach ($rekap as $r) :
                        ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $r['nama']; ?></td>
                                   <td><?= $r['jumlah_betul']; ?></td>
                                   <td><?= $r['jumlah_salah']; ?></td>
                                   <td><?= $r['score']; ?></td>
                                   <td>
                                   <?php
                                   if ($r['score'] >= 450) :
                                    echo '<span class="badge badge-success">Lulus</span>';
                                    else :
                                    echo '<span class="badge badge-danger">Gagal</span>';
                                    endif;
                                   ?>
                                   </td>
                                   <td><?= $r['tanggal']; ?></td>
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