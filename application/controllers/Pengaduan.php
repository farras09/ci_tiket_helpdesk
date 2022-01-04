<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        // 
    }

    public function index()
    {
        $data['title'] = 'Pengaduan';
        // $data['absensi'] = $this->admin->getJumlahPengaduan();
        $data['pengaduan'] = $this->admin->get('tkt_pengaduan', '', ['pgd_pg_nip' => $this->session->userdata('login_session')['nip']]);
        $this->template->load('templates/dashboard_pegawai', 'pengaduan/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'tk_uraian',
                'label' => 'Uraian Pengaduan',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Uraian pengaduan tidak boleh kosong'
                )
            ),

            // array(
            //     'field' => 'file',
            //     'label' => 'File',
            //     'rules' => 'required|trim',
            //     'errors' => array(
            //         'required' => 'File tidak boleh kosong'
            //     )
            //     ),


        );
        $this->form_validation->set_rules($config);
    }
    public function add()
    {

        $data['title'] = 'Pengaduan';
        $data['action'] = 'pengaduan/save';
        $data['kode'] =   $this->admin->kode_laporan();
        $data['teknisi'] = $this->admin->get('tkt_user', '', ['usr_role' => 'Teknisi IT']);
        $this->template->load('templates/dashboard_pegawai', 'pengaduan/add', $data);
    }

    public function save()
    {

        $this->_uploadFile();
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pengaduan';
            $data['action'] = 'pengaduan/save';
            $data['kode'] =   $this->admin->kode_laporan();
            setPesan(validation_errors(), false);
            $this->template->load('templates/dashboard_pegawai', 'pengaduan/add', $data);
        } else {
            $date = date('Y-m-d');
            $input = $this->input->post(null, true);
            $data_pengaduan = [
                'pgd_id' => $input['tk_id'],
                'pgd_pg_nip' => $input['pg_nip'],
                'pgd_tgl_pengaduan' => $date,
                'pgd_uraian_pengaduan' => $input['tk_uraian'],
                'pgd_biaya_perbaikan' => 0,
                'pgd_adm_status' => 'Diproses',
                'pgd_umum_status' => 'Diproses',
                'pgd_read_by_admin' => 0,
                'pgd_read_by_umum' => 0,

            ];

            $insert = $this->admin->insert('tkt_pengaduan', $data_pengaduan);
            if ($insert) {
                setPesan('Berhasil menambahkan pengaduan baru');
                redirect('pengaduan');
            } else {
                setPesan('Gagal menambahkan pengaduan baru');
                redirect('pengaduan/add');
            }
            /* Debug */
            //print_r($input);
        }
    }

    public function _uploadFile()
    {
        $config['upload_path'] = "./assets/files";
        $config['allowed_types'] = "pdf|jpeg|jpg|png";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '2000';

        $this->load->library('upload', $config);
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('tkt_pengaduan', 'pgd_id', $id)) {
            setPesan('pengaduan berhasil dihapus.');
        } else {
            setPesan('pengaduan gagal dihapus.', false);
        }
        redirect('pengaduan/dataPengaduan');
    }

    public function dataPengaduan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];

            if ($filter == '1') {
                if (isset($_GET['tanggal'])) {

                    $tgl = $_GET['tanggal'];
                    $ket = 'Laporan Data Pengaduan Pada Tanggal : ' . date('d-m-y', strtotime($tgl));
                    $url_cetak = '/cetakPengaduan?filter=1&tanggal=' . $tgl;
                    $url_export = '/export?filter=1&tanggal=' . $tgl;
                    $pengaduan = $this->admin->cetakPengaduanPerTanggal($tgl);
                }
            } else if ($filter == '2') {
                if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
                    $bulan = $_GET['bulan'];
                    if ($bulan == "") {
                        $bulan = 0;
                    }
                    $tahun = $_GET['tahun'];
                    $nama_bulan = array(
                        '',
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    );
                    // echo $bulan;
                    $ket = 'Laporan Data Pengaduan Pada Bulan : ' . $nama_bulan[$bulan] . ' ' . $tahun;
                    $url_cetak = '/cetakPengaduan?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
                    $url_export = '/export?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
                    $pengaduan = $this->admin->cetakPengaduanPerBulan($bulan, $tahun);
                } else {
                    echo "error";
                }
            } else {
                if (isset($_GET['tahun'])) {

                    $tahun = $_GET['tahun'];
                    $ket = 'Laporan Data Pengaduan Pada Tahun : ' . $tahun;
                    $url_cetak = '/cetakPengaduan?filter=3&tahun=' . $tahun;
                    $url_export = '/export?filter=3&tahun=' . $tahun;
                    $pengaduan = $this->admin->cetakPengaduanPerTahun($tahun);
                }
            }
        } else {
            // $filter = '3';
            $ket = 'Data Pengaduan';
            $url_cetak = '/cetakPengaduan';
            $url_export = '/export';
            if (isBagianUmum()) :
                $pengaduan = $this->admin->cetakPengaduan(1);
            else :
                $pengaduan = $this->admin->cetakPengaduan();
            endif;
        }
        // $data['filter'] = $filter;
        $data['keterangan'] = $ket;
        if (isTeknisi()) :
            $data['data_pengaduan'] = $this->admin->getPenugasan($this->session->userdata('login_session')['nama']);
        else :

            $data['data_pengaduan'] = $pengaduan;
        endif;
        $data['url_cetak'] = site_url('Pengaduan' . $url_cetak);
        $data['url_export'] = site_url('Pengaduan' . $url_export);
        $data['tahun'] = $this->admin->tahunPengaduan();
        $data['title'] = 'Data Pengaduan Masuk';
        if (isBagianUmum()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        } elseif (isAdmin()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        }
        $data['pengaduan'] = $this->admin->notifPengajuanAdmin();
        // $data['data_pengaduan'] = $this->admin->dataPengaduan();
        $this->template->load('templates/dashboard', 'pengaduan/dataPengaduan', $data);
    }
    public function detailTracking($nomor_tracking)
    {
        $data['title'] = 'Tracking';
        $data['tracking'] = $this->admin->get('tkt_tracking', '', ['trck_pgd_id' => $nomor_tracking]);
        $this->template->load('templates/dashboard_pegawai', 'tracking/detailTracking', $data);
    }
    public function cetakPengaduan()
    {

        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];

            if ($filter == '1') {
                $tgl = $_GET['tanggal'];
                $ket = 'Laporan Data Pengaduan Pada Tanggal : ' . date('d-m-y', strtotime($tgl));
                // $url_cetak = '/cetakPengaduan?filter=1&tanggal='.$tgl;
                $pengaduan = $this->admin->cetakPengaduanPerTanggal($tgl);
            } else if ($filter == '2') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array(
                    '',
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                );
                $ket = 'Laporan Data Pengaduan Pada Bulan : ' . $nama_bulan[$bulan] . ' ' . $tahun;
                // $url_cetak = '/cetakPengaduan?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
                $pengaduan = $this->admin->cetakPengaduanPerBulan($bulan, $tahun);
            } else {
                $tahun = $_GET['tahun'];
                $ket = 'Laporan Data Pengaduan Pada Tahun : ' . $tahun;
                // $url_cetak = '/cetakPengaduan?filter=3&tahun='.$tahun;
                $pengaduan = $this->admin->cetakPengaduanPerTahun($tahun);
            }
        } else {
            // $filter = '3';
            $ket = 'Data Pengaduan';
            // $url_cetak = '/cetakPengaduan';
            $pengaduan = $this->admin->cetakPengaduan();
        }

        $pdf = new FPDF('l', 'mm', 'A3');
        // membuat halaman baru
        $pdf->AddPage();
        // Logo
        $pdf->Image(base_url('assets/images/kop.jpg'), 100, 6, 200);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);

        // Line break
        $pdf->Ln(40);



        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);


        $pdf->SetMargins(10, 4);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 15, 'ID LAPORAN', 1, 0, 'C');
        $pdf->Cell(40, 15, 'TANGGAL LAPORAN', 1, 0, 'C');
        $pdf->Cell(65, 15, 'NAMA PEGAWAI', 1, 0, 'C');
        $pdf->Cell(60, 15, 'URAIAN PENGADUAN', 1, 0, 'C');
        $pdf->Cell(70, 15, 'KETERANGAN PERBAIKAN', 1, 0, 'C');
        $pdf->Cell(40, 15, 'BIAYA PERBAIKAN', 1, 0, 'C');
        $pdf->Cell(50, 15, 'JUMLAH BIAYA PERBAIKAN', 1, 0, 'C');
        $pdf->Cell(35, 15, 'STATUS', 1, 1, 'C');



        $pdf->SetFont('Arial', '', 10);
        $total = 0;
        foreach ($pengaduan as $data) {
            // $pdf->SetFillColor(255, 255, 255);
            // $pdf->Cell(35, 15, $data['pgd_id'], 1, 0, 'C', true); //sesuaikan ketinggian dengan jumlah garis
            // $pdf->Cell(40, 15, $data['pgd_tgl_pengaduan'], 1,0, 'C');
            // $pdf->Cell(65, 15, $data['pg_nama'], 1, 0, 'C'); //sesuaikan ketinggian dengan jumlah garis
            // $pdf->Cell(50, 15, $data['pgd_uraian_pengaduan'], 1, 0, 'C');
            // $pdf->Cell(70, 15, $data['pgd_adm_keterangan'], 1,0,  'C');
            // $pdf->Cell(40, 15,  $data['pgd_biaya_perbaikan'] == 1 ? "Ada" : "Tidak Ada", 1, 0, 'C');
            // $pdf->Cell(50, 15, rupiah($data['pgd_jumlah_biaya_perbaikan']), 1, 0, 'C');
            // $pdf->Cell(35, 15,  $data['pgd_umum_status'], 1, 1, 'C');
            $cellWidth = 60; //lebar sel
            $cellHeight = 10; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($data['pgd_uraian_pengaduan']) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($data['pgd_uraian_pengaduan']);    //total panjang teks
                $errMargin = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar = 0;        //posisi awal karakter untuk setiap baris
                $maxChar = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray = array();    //untuk menampung data untuk setiap baris
                $tmpString = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
                        ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($data['pgd_umum_keterangan'], $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            //tulis selnya
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(35, ($line * $cellHeight), $data['pgd_id'], 1, 0, 'C', true); //sesuaikan ketinggian dengan jumlah garis
            $pdf->Cell(40, ($line * $cellHeight), $data['pgd_tgl_pengaduan'], 1, 0, 'C');
            $pdf->Cell(65, ($line * $cellHeight), $data['pg_nama'], 1, 0, 'C'); //sesuaikan ketinggian dengan jumlah garis
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            // $pdf->MultiCell($cellWidth, $cellHeight, $data['pgd_umum_keterangan'], 1, 'C');
            $pdf->MultiCell($cellWidth, $cellHeight, $data['pgd_uraian_pengaduan'], 1,  'C');
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            $pdf->Cell(70, ($line * $cellHeight), $data['pgd_adm_keterangan'], 1, 0, 'C');
            $pdf->Cell(40, ($line * $cellHeight),  $data['pgd_biaya_perbaikan'] == 1 ? "Ada" : "Tidak Ada", 1, 0, 'C');
            $pdf->Cell(50, ($line * $cellHeight), rupiah($data['pgd_jumlah_biaya_perbaikan']), 1, 0, 'C');
            $pdf->Cell(35, ($line * $cellHeight),  $data['pgd_umum_status'], 1, 1, 'C');

            $total += $data['pgd_jumlah_biaya_perbaikan'];
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell


            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            // $pdf->SetXY($xPos + $cellWidth, $yPos);

            // $pdf->MultiCell(35, ($line * $cellHeight), $data['pgd_umum_keterangan'], 1, 1);
            // $pdf->Cell(35, 15, $data['pgd_id'], 1, 0);
            // $pdf->Cell(65, 15, $data['pg_nama'], 1, 0);

        }
        $pdf->Cell(310, ($line * $cellHeight), 'Total Biaya Perbaikan : ', 1, 0, 'C');
        $pdf->Cell(50, ($line * $cellHeight), rupiah($total), 1, 0, 'C');
        $pdf->Cell(35, ($line * $cellHeight), '', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(40);
        $pdf->Cell(380, 7, 'Pekanbaru' . ", " . date('Y-m-d'), 0, 1, 'R');
        $pdf->Cell(10, 20, '', 0, 1, 'R');
        $pdf->Cell(380, 7, 'Kepala Bagian Umum', 0, 1, 'R');
        $pdf->Output();
    }


    public function export()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];

            if ($filter == '1') {
                if (isset($_GET['tanggal'])) {

                    $tgl = $_GET['tanggal'];

                    $ket = 'Laporan Data Pengaduan Pada Tanggal : ' . date('d-m-y', strtotime($tgl));
                    // $url_cetak = '/cetakPengaduan?filter=1&tanggal='.$tgl;
                    $data['pengaduan'] = $this->admin->cetakPengaduanPerTanggal($tgl);
                } else {
                    $data['pengaduan'] = $this->admin->cetakPengaduan();
                }
            } else if ($filter == '2') {
                if (isset($_GET['bulan']) &&  isset($_GET['bulan'])) {

                    $bulan = $_GET['bulan'];
                    $tahun = $_GET['bulan'];;
                    $nama_bulan = array(
                        '',
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    );
                    $ket = 'Laporan Data Pengaduan Pada Bulan : ' . $nama_bulan[$bulan] . ' ' . $tahun;
                    // $url_cetak = '/cetakPengaduan?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
                    $data['pengaduan'] = $this->admin->cetakPengaduanPerBulan($bulan, $tahun);
                } else {
                    $data['pengaduan'] = $this->admin->cetakPengaduan();
                }
            } else {
                if (isset($_GET['tahun'])) {

                    $tahun = $_GET['tahun'];
                    $ket = 'Laporan Data Pengaduan Pada Tahun : ' . $tahun;
                    // $url_cetak = '/cetakPengaduan?filter=3&tahun='.$tahun;
                    $data['pengaduan'] = $this->admin->cetakPengaduanPerTahun($tahun);
                } else {
                    $data['pengaduan'] = $this->admin->cetakPengaduan();
                }
            }
        } else {
            // $filter = '3';
            $ket = 'Data Pengaduan';
            // $url_cetak = '/cetakPengaduan';
            $data['pengaduan'] = $this->admin->cetakPengaduan();
        }

        // $data['pengaduan'] = $this->admin->cetakPengaduan();

        include_once APPPATH . '/PHPExcel/PHPExcel.php';
        include_once APPPATH . '/PHPExcel/PHPExcel/Writer/Excel2007.php';


        $objPhpExcel = new PHPExcel();

        // $objPhpExcel->getProperties()->setCreator("codeXV");
        // $objPhpExcel->getProperties()->setLastModifiedBy("codeXV");
        // $objPhpExcel->getProperties()->setTitle("Data Pengaduan");
        // $objPhpExcel->getProperties()->setSubject("codeXV");
        // $objPhpExcel->getProperties()->setDescription("Data Pengaduan PN Kendari");

        $objPhpExcel->setActiveSheetIndex(0);

        $objPhpExcel->getActiveSheet()->setCellValue('A1', 'ID LAPORAN');
        $objPhpExcel->getActiveSheet()->setCellValue('B1', 'TANGGAL PENGADUAN');
        $objPhpExcel->getActiveSheet()->setCellValue('C1', 'NAMA PEGAWAI');
        $objPhpExcel->getActiveSheet()->setCellValue('D1', 'URAIAN PENGADUAN');
        $objPhpExcel->getActiveSheet()->setCellValue('E1', 'KETERANGAN PERBAIKAN');
        $objPhpExcel->getActiveSheet()->setCellValue('F1', 'PERKIRAAN BIAYA');
        $objPhpExcel->getActiveSheet()->setCellValue('G1', 'BIAYA PERBAIKAN');
        $objPhpExcel->getActiveSheet()->setCellValue('N1', 'STATUS');


        $baris = 2;
        $x = 1;
        $total = 0;
        foreach ($data['pengaduan'] as $p) {
            $objPhpExcel->getActiveSheet()->setCellValue('A' . $baris, $p['pgd_id']);
            $objPhpExcel->getActiveSheet()->setCellValue('B' . $baris, $p['pgd_tgl_pengaduan']);
            $objPhpExcel->getActiveSheet()->setCellValue('C' . $baris, $p['pg_nama']);
            $objPhpExcel->getActiveSheet()->setCellValue('D' . $baris, $p['pgd_uraian_pengaduan']);
            $objPhpExcel->getActiveSheet()->setCellValue('E' . $baris, $p['pgd_adm_keterangan']);
            $objPhpExcel->getActiveSheet()->setCellValue('F' . $baris, $p['pgd_biaya_perbaikan'] == 1 ? "Ada" : "Tidak Ada");
            $objPhpExcel->getActiveSheet()->setCellValue('G' . $baris, rupiah($p['pgd_jumlah_biaya_perbaikan']));
            $objPhpExcel->getActiveSheet()->setCellValue('H' . $baris, $p['pgd_umum_status']);

            $total += $p['pgd_jumlah_biaya_perbaikan'];

            $baris++;
        }
        $objPhpExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPhpExcel->getActiveSheet()->setCellValue('G' . $baris, rupiah($total));


        $filename = "Data Pengaduan" . 'xlsx';

        $objPhpExcel->getActiveSheet()->setTitle('Data Pengaduan');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename"' . $filename . '"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
        $write->save('php://output');

        exit;
    }

    public function editPengaduan($id)
    {
        $data['title'] = 'Form Pengaduan';
        $data['action'] = 'pengaduan/updatePengaduan';
        $data['teknisi'] = $this->admin->get('tkt_user', '', ['usr_role' => 'Teknisi IT']);
        if (isBagianUmum()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
            $data['pengaduan'] = $this->admin->notifPengajuanAdmin();
        } elseif (isAdmin()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanAdmin();
        }
        $data['data_pengaduan'] = $this->admin->getPengaduan($id);
        $this->template->load('templates/dashboard', 'pengaduan/editPengaduan', $data);
    }


    public function updatePengaduan()
    {
        $id = $this->input->post('pgd_id');
        // $input = $this->input->post(null, true);
        if (isAdmin()) {
            $data = [
                'pgd_biaya_perbaikan' => $this->input->post('pgd_biaya_perbaikan'),
                'pgd_teknisi' => $this->input->post('pgd_teknisi'),
                'pgd_adm_keterangan' => $this->input->post('pgd_adm_keterangan'),
                'pgd_jumlah_biaya_perbaikan' => $this->input->post('pgd_jumlah_biaya_perbaikan'),

            ];
        } else if (isBagianUmum()) {
            $status = $this->input->post('verifikasi');
            if ($status == 0) {
                $status = "Ditunda";
            } else {
                $status = "Diterima";
            }
            $data = [
                'pgd_umum_status' => $status,
                'pgd_umum_keterangan' => $this->input->post('pgd_umum_keterangan'),
            ];
        } else {
            $status_perbaikan = $this->input->post('pgd_teknisi_status');
            $data = [
                'pgd_teknisi_status' => $status_perbaikan
            ];
        }
        $update = $this->admin->update('tkt_pengaduan', 'pgd_id', $id, $data);


        if ($update) {
            setPesan('Berhasil update data');
            if (isTeknisi()) :
                redirect('penugasan/dataPenugasan');
            else :
                redirect('pengaduan/dataPengaduan');
            endif;
        } else {
            setPesan('Gagal update data');
            redirect('pengaduan/dataPengaduan/' . $id);
        }
    }

    public function read()
    {

        if (isAdmin()) {

            $this->admin->updateMass('tkt_pengaduan', ['pgd_adm_status' => 'Diterima', 'pgd_read_by_admin' => 1]);
        } elseif (isBagianUmum()) {
            $this->admin->updateMass('tkt_pengaduan', ['pgd_read_by_umum' => 1]);
        }

        redirect('pengaduan/dataPengaduan');
    }



    public function verifikasiPengaduan()
    {
        $id = $this->input->post('pgd_id');
        // $input = $this->input->post(null, true);
        $data = [
            'pgd_biaya_perbaikan' => $this->input->post('pgd_biaya_perbaikan'),
            'pgd_adm_keterangan' => $this->input->post('pgd_adm_keterangan'),

        ];
        $update = $this->admin->update('tkt_pengaduan', 'pgd_id', $id, $data);


        if ($update) {
            setPesan('Berhasil update pengaduan');
            redirect('pengaduan/dataPengajuan');
        } else {
            setPesan('Gagal update pengaduan');
            redirect('pengaduan/dataPengajuan/' . $id);
        }
    }

    public function pengaduanDiterima()
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        $data['pengaduan'] = $this->admin->notifPengajuanAdmin();
        $data['title'] = 'Data Pengaduan Diterima';
        $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        $data['data_pengaduan'] = $this->admin->dataRekapPengaduan('Diterima');
        $this->template->load('templates/dashboard', 'pengaduan/rekapPengaduan', $data);
    }

    public function pengaduanDitunda()
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        $data['pengaduan'] = $this->admin->notifPengajuanAdmin();
        $data['title'] = 'Data Pengaduan Ditunda';
        $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        $data['data_pengaduan'] = $this->admin->dataRekapPengaduan('Ditunda');
        $this->template->load('templates/dashboard', 'pengaduan/rekapPengaduan', $data);
    }
}
