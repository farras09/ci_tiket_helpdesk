<?php
date_default_timezone_set('Asia/Jakarta');

?>
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
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
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Diterima</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_diterima; ?></div>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Jumlah Pengaduan Ditunda</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_ditunda; ?></div>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-danger"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Linimasa</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <?php if (isset($tracking)) : ?>
                            <div class="col-md-6 offset-md-3">
                                <h4>Status Laporan Terkini </h4>
                                <p>ID Laporan : <?= $tracking[0]['trck_pgd_id']; ?></p>
                                <ul class="timeline">

                                    <?php foreach ($tracking as $data) : ?>
                                        <li>
                                            <a href="#"><?= $data['trck_status']; ?></a>
                                            <a href="#" class="float-right"><?= $data['trck_tgl']; ?></a>
                                            <p><?= $data['trck_keterangan']; ?></p>
                                        </li>
                                    <?php endforeach; ?>



                                </ul>
                            </div>
                        <?php
                        else :
                            echo "Belum Ada Perkembangan";
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>