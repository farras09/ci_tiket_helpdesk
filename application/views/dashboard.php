<?php if (isAdmin()) { ?>
    <!-- Content Row -->
    <div class="row">


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pegawai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pegawai; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-success shadow h-100 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                   Jabatan</div>
                               <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jabatan; ?></div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div> -->

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Bidang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $bidang; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pengaduan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php } ?>

<!-- Content Row -->
<div class="row">
    
    <?php if(isTeknisi()) :?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Diterima</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_diproses; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-primary"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_diterima; ?> </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Belum Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $pengaduan_ditunda; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else:?>
     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-4 col-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_diproses; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-primary"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>
       <!-- Earnings (Monthly) Card Example -->
       <div class="col-xl-4 col-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Diterima</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_diterima; ?> </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Ditunda</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $pengaduan_ditunda; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>