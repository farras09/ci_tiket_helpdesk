<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'admin');
        // if (isAdmin()) {
        //     $this->initabsen();
        // }
        // $this->initabsen();
        cekLogin();
    }

    public function index()
    {
        $data['title'] = 'Selamat Datang ' . $this->session->userdata('login_session')['nama'];
        $data['pegawai'] = $this->admin->count('tkt_pegawai');
        // $data['jabatan'] = $this->admin->count('tb_jabatan');
        $data['bidang'] = $this->admin->count('tkt_bidang');
        if (isBagianUmum()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        } elseif (isAdmin()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        }
        if (isAdmin()) {
            $data['pengaduan'] = $this->admin->notifPengajuanAdmin();
        } else if (isBagianUmum()) {
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        }
        $data['jumlah_pengaduan'] = $this->admin->getJumlahPengaduanPerHari();
        $data['pengaduan_diproses'] = $this->admin->jumlahPengaduanByUmum();
        $data['pengaduan_diterima'] = $this->admin->getJumlahPengaduan('Diterima');
        $data['pengaduan_ditunda'] = $this->admin->getJumlahPengaduan('Ditunda');
        if (isTeknisi()) {
            $data['pengaduan_diproses'] = count($this->admin->getPenugasan($this->session->userdata('login_session')['nama']));
            $data['pengaduan_diterima'] = $this->admin->getStatusPenugasan($this->session->userdata('login_session')['nama'], 'Sudah Selesai');
            $data['pengaduan_ditunda'] = $this->admin->getStatusPenugasan($this->session->userdata('login_session')['nama'], 'Belum Selesai');
        }
        $this->template->load('templates/dashboard', 'dashboard', $data);
    }



    public function pegawai()
    {

        $this->load->helper('date');
        $data['title'] = 'Dashboard';
        $data['time'] = "%Y-%m-%d %h:%i %a";
        $data['pengaduan_diproses'] = $this->admin->getJumlahPengaduanPerPegawai($this->session->userdata('login_session')['nip'], 'Diproses');
        $data['pengaduan_diterima'] = $this->admin->getJumlahPengaduanPerPegawai($this->session->userdata('login_session')['nip'], 'Diterima');
        $data['pengaduan_ditunda'] = $this->admin->getJumlahPengaduanPerPegawai($this->session->userdata('login_session')['nip'], 'Ditolak');
        $track = $this->admin->getTrackingLaporan($this->session->userdata('login_session')['nip']);
        if (isset($track['pgd_id'])) {
            $detail_tracking = $this->admin->get('tkt_tracking', '', ['trck_pgd_id' => $track['pgd_id']]);
            if (count($detail_tracking) > 0) {

                $data['tracking'] = $this->admin->get('tkt_tracking', '', ['trck_pgd_id' => $track['pgd_id']]);
            }
        }
        $this->template->load('templates/dashboard_pegawai', 'pegawai/dashboard', $data);
    }
}
