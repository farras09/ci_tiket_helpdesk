<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'admin');
        cekLogin();
        // $this->initabsen();
    }


    // public function initabsen()
    // {
    //     $date = date('Y-m-d');
    //     $cek_date = $this->admin->get('tb_absensi', ['tanggal_masuk = ' => $date]);
    //     if ($cek_date == NULL) {
    //         $pegawai = $this->admin->get('tb_pegawai');
    //         foreach ($pegawai as $data) {
    //             $array = array(
    //                 'pegawai_nip' => $data['nip'],
    //                 'tanggal_masuk' => $date,
    //                 'jam_masuk' => "",
    //                 'jam_keluar' => "",
    //             );
    //             $this->admin->insert('tb_absensi', $array);
    //         }

    //         //  var_dump($cek_date);
    //     }
    // }

    public function absensi()
    {
        $data['notifikasi'] = $this->admin->jumlahPengajuan();
        $data['pengajuan'] = $this->admin->notifPengajuan();
        $data['title'] = 'Data Absensi Pegawai';
        $data['absensi'] = $this->admin->getAbsensi();
        $data['keterangan'] = $this->admin->get('tb_lokasi_pegawai');
        $this->template->load('templates/dashboard', 'absensi/absensi', $data);
    }

    public function seluruhabsensi()
    {
        $data['notifikasi'] = $this->admin->jumlahPengajuan();
        $data['pengajuan'] = $this->admin->notifPengajuan();
        $data['title'] = 'Data Absensi Pegawai';
        $data['absensi'] = $this->admin->getAllAbsensi();
        $data['keterangan'] = $this->admin->get('tb_lokasi_pegawai');
        $this->template->load('templates/dashboard', 'absensi/absensi', $data);
    }


    public function updateAbsenPegawai()
    {

        $id = encode_php_tags($this->input->post('id'));
        // $input=$this->input->post(null,true);
        $data = array(
            'tanggal_masuk' => date('Y-m-d'),
            'status_kehadiran_id' => $this->input->post('status_kehadiran_id'),
            'lokasi_pegawai_id' => $this->input->post('lokasi_pegawai_id'),

        );
        //  var_dump($data);
        $update = $this->admin->update('tb_absensi', 'id', $id, $data);
        // print_r($id);
        if ($update) {
            setPesan('Berhasil absen');
            redirect('absensi/absensi');
        } else {
            setPesan('Gagal absen');
            redirect('absensi/absensi');
        }
    }


    public function inputAbsen()
    {

        $jam = date('Y-m-d H:i:s');

        $data = array(
            'pegawai_nip' => $this->session->userdata('login_session')['nip'],
            'tanggal_masuk' => date('Y-m-d'),
            'jam_masuk' => $jam,
            'jam_keluar' => "",
            'status_kehadiran_id' => "",
            'lokasi_pegawai_id' => "",

        );

        $insert = $this->admin->insert('tb_absensi', $data);

        if ($insert) {
            setPesan('Berhasil absen');
            redirect('dashboard/pegawai');
        } else {
            setPesan('Gagal absen');
            redirect('dashboard/add');
        }
    }

    public function updateAbsenMasuk()
    {
        $id = encode_php_tags($this->input->post('id'));
        $lat = 0.46385583576375367;
        $long = 101.41722032329635;

        $keterangan = "";
        if ($this->input->post('lat') == $lat && $this->input->post('long') == $long) {
            $keterangan = "WFO";
        } else {
            $keterangan = "WFH";
        }

        if (time() <= strtotime("08:00:00")) {

            $data = array(
                'pegawai_nip' => $this->session->userdata('login_session')['nip'],
                // 'tanggal_masuk' => date('Y-m-d'),
                'jam_masuk' =>  $this->input->post('jam_masuk'),
                // 'jam_keluar' => $this->input->post('jam_keluar'),
                'latitude' => $this->input->post('lat'),
                'longitude' => $this->input->post('long'),
                'status_kehadiran_id' => 'Hadir',
                'lokasi_pegawai_id' => $keterangan,

            );
            # code...
        } elseif (time() >= strtotime("08:00:00")) {
            $data = array(
                'pegawai_nip' => $this->session->userdata('login_session')['nip'],
                // 'tanggal_masuk' => date('Y-m-d'),
                'jam_masuk' =>  $this->input->post('jam_masuk'),
                // 'jam_keluar' => $this->input->post('jam_keluar'),
                'latitude' => $this->input->post('lat'),
                'longitude' => $this->input->post('long'),
                'status_kehadiran_id' => 'Terlambat',
                'lokasi_pegawai_id' => $keterangan,

            );
        }
        //  var_dump($data);
        $update = $this->admin->update('tb_absensi', 'id', $id, $data);

        if ($update) {
            setPesan('Berhasil absen');
            redirect('dashboard/pegawai');
        } else {
            setPesan('Gagal absen');
            redirect('dashboard/add');
        }
    }

    public function updateAbsenKeluar()
    {

        $id = encode_php_tags($this->input->post('id'));
        $data = array(
            'pegawai_nip' => $this->session->userdata('login_session')['nip'],
            // 'tanggal_masuk' => date('Y-m-d'),
            //  'jam_masuk' =>  $this->input->post('jam_masuk'),
            'jam_keluar' => $this->input->post('jam_keluar'),
            // 'status_kehadiran_id' => "",
            // 'lokasi_pegawai_id' => "",

        );

        $update = $this->admin->update('tb_absensi', 'id', $id, $data);

        if ($update) {
            setPesan('Berhasil absen');
            redirect('dashboard/pegawai');
        } else {
            setPesan('Gagal absen');
            redirect('dashboard/add');
        }
    }

    public function pegawai()
    {
        $data['title'] = 'Dashboard';
        $this->template->load('templates/dashboard_pegawai', 'pegawai/dashboard', $data);
    }

    public function historyPresensi()
    {
        $data['title'] = 'History Presensi';
        $data['absen'] = $this->admin->getHistoryAbsensi($this->session->userdata('login_session')['nip']);
        $this->template->load('templates/dashboard_pegawai', 'pegawai/history', $data);
    }
}
