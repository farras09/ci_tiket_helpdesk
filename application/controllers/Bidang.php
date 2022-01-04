<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Bidang';
        $data['bidang'] = $this->admin->get('tkt_bidang');
        $this->template->load('templates/dashboard', 'bidang/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'bd_nama_bidang',
                'label' => 'Bidang',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Bidang tidak boleh kosong'
                )
            )

        );
        $this->form_validation->set_rules($config);
    }
    public function add()
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Bidang';
        $data['action'] = 'bidang/save';
        $this->template->load('templates/dashboard', 'bidang/add', $data);
    }

    public function save()
    {

        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Bidang';
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['action'] = 'bidang/save';
            setPesan(validation_errors(),false);
            $this->template->load('templates/dashboard', 'bidang/add', $data);
        } else {
            $input = $this->input->post(null, true);


            $insert = $this->admin->insert('tkt_bidang', $input);

            if ($insert) {
                setPesan('Berhasil menambahkan bidang baru');
                redirect('bidang');
            } else {
                setPesan('Gagal menambahkan bidang baru');
                redirect('bidang/add');
            }

            /* Debug */
            //print_r($input);
        }
    }
    public function edit($getId)
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Bidang';
        $data['action'] = 'bidang/update';
        $data['bidang'] = $this->admin->get('tkt_bidang', ['bd_id' => $getId]);
        $this->template->load('templates/dashboard', 'bidang/edit', $data);
    }
    public function update()
    {

        $this->_validasi();
        $id = encode_php_tags($this->input->post('bd_id'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'bidang';  
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['action'] = 'bidang/update';
            $data['bidang'] = $this->admin->get('tkt_bidang', ['bd_id' => $id]);
            $this->template->load('templates/dashboard', 'bidang/edit', $data);
        } else {

            $input = $this->input->post(null, true);

            $update = $this->admin->update('tkt_bidang', 'bd_id', $id, $input);

            if ($update) {
                setPesan('Berhasil update bidang');
                redirect('bidang');
            } else {
                setPesan('Gagal update bidang');
                redirect('bidang/edit/' . $id);
            }



            /* Debug */
            //print_r($input);
        }
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('tkt_bidang', 'bd_id', $id)) {
            setPesan('Bidang berhasil dihapus.');
        } else {
            setPesan('Bidang gagal dihapus.', false);
        }
        redirect('bidang');
    }
}
