<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Master <?= $title; ?> | Aplikasi Ticketing Helpdesk</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- <a href="<?= base_url(); ?>" ><img src="<?= base_url(); ?>assets/images/logo.jpg" alt="Logo" class="img-fluid container"></a> -->
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-text mx-1">Aplikasi Ticket Desk</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= site_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php if (isAdmin() ) : ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item <?= $this->uri->segment(1) == 'absensi' || $this->uri->segment(1) == 'pengaduan'  ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user-check"></i>
                        <span>Data Pengaduan Masuk</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Master:</h6>
                            <!-- <a class="collapse-item" href="<?= site_url('absensi/absensi'); ?>">Data Pengajuan Hari Ini</a>
                            <a class="collapse-item" href="<?= site_url('absensi/seluruhabsensi'); ?>">Seluruh Data pengaduan</a> -->
                            <a class="collapse-item" href="<?= site_url('pengaduan/dataPengaduan'); ?>">Data Pengaduan</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if (isTeknisi() ) : ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item <?=  $this->uri->segment(1) == 'penugasan'  || $this->uri->segment(1) == 'tracking' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('penugasan/dataPenugasan'); ?>">
                        <i class="fas fa-fw fa-tasks"></i>
                        <span>Data Penugasan </span>
                    </a>
                   
                </li>
            <?php endif; ?>



            <?php if (isAdmin()) : ?>
                <!-- Nav Item - Jabatan -->
                <li class="nav-item <?= $this->uri->segment(1) == 'bidang' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('bidang'); ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Data Bidang</span></a>
                </li>
            <?php endif; ?>

            <?php if (isAdmin()) : ?>
                <!-- Nav Item - Lokasi Pegawai -->
                <!-- <li class="nav-item <?= $this->uri->segment(1) == 'lokasi_pegawai' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('lokasi_pegawai'); ?>">
                        <i class="fas fa-fw fa-map"></i>
                        <span>Keterangan Pegawai</span></a>
                </li> -->
            <?php endif; ?>

            <?php if (isAdmin()) : ?>
                <!-- Nav Item - Pegawai -->
                <li class="nav-item <?= $this->uri->segment(1) == 'pegawai' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('pegawai'); ?>">
                        <i class="fas fa-fw fa-id-badge"></i>
                        <span>Data Pegawai</span></a>
                </li>
            <?php endif; ?>

            <?php if (isAdmin()) : ?>
                <!-- Nav Item - User -->
                <li class="nav-item <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == '' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('user'); ?>">
                        <i class="fas fa-fw fa-user-cog"></i>
                        <span>Data User</span></a>
                </li>
                <li class="nav-item <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'teknisi' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('user/teknisi'); ?>">
                        <i class="fas fa-fw fa-user-cog"></i>
                        <span>Data Teknisi</span></a>
                </li>
            <?php endif; ?>


            <?php if (isBagianUmum()) : ?>
                <!-- Nav Item - User -->
                <!-- <li class="nav-item <?= $this->uri->segment(1) == 'pengaduan' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('pengaduan/dataPengaduan'); ?>">
                        <i class="fas fa-fw fa-inbox"></i>
                        <span>Pengaduan Masuk</span></a>
                </li> -->

                <li class="nav-item <?= $this->uri->segment(1) == 'pengaduan'  ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user-check"></i>
                        <span>Data Pengaduan</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Master:</h6>
                            <a class="collapse-item" href="<?= site_url('pengaduan/dataPengaduan'); ?>">Data Pengaduan Masuk</a>
                            <a class="collapse-item" href="<?= site_url('pengaduan/pengaduanDiterima'); ?>">Data Pengaduan Diterima</a>
                            <a class="collapse-item" href="<?= site_url('pengaduan/pengaduanDitunda'); ?>">Data Pengaduan Ditunda</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - User -->
                <li class="nav-item <?= $this->uri->segment(1) == 'user' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('user/profile/' . $this->session->userdata('login_session')['id']); ?>">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Profile</span></a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <?php if (isBagianUmum()) : ?>
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter"><?= $notifikasi; ?></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Pengajuan Masuk
                                    </h6>
                                    <?php if ($pengaduan) :
                                        foreach ($pengaduan as $data) : ?>
                                            <a class="dropdown-item d-flex align-items-center" href="<?= site_url('pengaduan/read'); ?>">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="small text-gray-500"><?= $data['pg_nama']; ?></div>
                                                    <div class="medium text-gray-800"><?= $data['pgd_uraian_pengaduan']; ?></div>
                                                    <span class="font-weight-bold"><?= $data['pgd_adm_keterangan']; ?></span>
                                                </div>
                                            </a>

                                        <?php endforeach; ?>
                                    <?php else : ?>

                                        <p class="text-center small text-danger mt-3" href="#">Tidak ada pengajuan</p>

                                    <?php endif; ?>

                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if (isAdmin()) : ?>
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter"><?= $notifikasi; ?></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Pengajuan Masuk Diterima
                                    </h6>
                                    <?php if ($pengaduan) :
                                        foreach ($pengaduan as $data) : ?>
                                            <a class="dropdown-item d-flex align-items-center" href="<?= site_url('pengaduan/read'); ?>">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="small text-gray-500"><?= $data['pg_nama']; ?></div>
                                                    <span class="font-weight-bold"><?= $data['pgd_uraian_pengaduan']; ?></span>
                                                </div>
                                            </a>

                                        <?php endforeach; ?>
                                    <?php else : ?>

                                        <p class="text-center small text-danger mt-3" href="#">Tidak ada pengajuan yang diterima</p>

                                    <?php endif; ?>

                                </div>
                            </li>
                        <?php endif; ?>

                        <?php if (isTeknisi()) : ?>
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter"><?= $notifikasi; ?></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Pengajuan Masuk Diterima
                                    </h6>
                                    <?php if ($pengaduan) :
                                        foreach ($pengaduan as $data) : ?>
                                            <a class="dropdown-item d-flex align-items-center" href="<?= site_url('pengaduan/read'); ?>">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="small text-gray-500"><?= $data['pg_nama']; ?></div>
                                                    <span class="font-weight-bold"><?= $data['pgd_uraian_pengaduan']; ?></span>
                                                </div>
                                            </a>

                                        <?php endforeach; ?>
                                    <?php else : ?>

                                        <p class="text-center small text-danger mt-3" href="#">Tidak ada pengajuan yang diterima</p>

                                    <?php endif; ?>

                                </div>
                            </li>
                        <?php endif; ?>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('login_session')['nama']; ?></span>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <?= $contents; ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Aplikasi Ticketing Helpdesk</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= site_url('auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>assets/js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#input-tanggal1').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $('.js-example-basic-multiple').select2();
            $('#form-tanggal, #form-bulan, #form-tahun').hide();
            $('#filter').change(function() {
                if ($(this).val() == '1') {
                    $('#form-bulan, #form-tahun').hide();
                    $('#form-tanggal').show();


                } else if ($(this).val() == '2') {
                    $('#form-tanggal').hide();
                    $('#form-bulan, #form-tahun').show();
                } else {
                    $('#form-tanggal, #form-bulan').hide();
                    $('#form-tahun').show();
                }

                $('#form-tanggal input, #form-bulan select, #form-tahun select').val('');
            })
        })
    </script>

    <script>
        // $(function(){
        //     $('#status_perbaikan').on('change', function(){
        //         if ($(this).val()==1) {
        //             $('#perkiraan_perbaikan').html('<div class="row form-group"><label class="col-md-3 text-md-right" for="keterangan">Perkiraan Perbaikan</label><div class="col-md-9"><textarea class="form-control" name="pgd_adm_keterangan" id="" cols="30" rows="10"></textarea><?= form_error('pgd_adm_keterangan', '<small class="text-danger">', '</small>'); ?></div></div>')
        //         }else {
        //             $('#perkiraan_perbaikan').html('');
        //         }

        //     })
        // });
    </script>
</body>

</html>