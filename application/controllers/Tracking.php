<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index($id = null)
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Tracking';
        $data['id']=$id;
        $data['tracking'] = $this->admin->get('tkt_tracking','', ['trck_pgd_id' => $id]);
        $this->template->load('templates/dashboard', 'tracking/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'trck_status',
                'label' => 'Progress Laporan',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Progress Laporan tidak boleh kosong'
                )
            )

        );
        $this->form_validation->set_rules($config);
    }
    public function add($id)
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Tracking';
        $data['id']=$id;
        $data['action'] = 'tracking/save/'.$id;
        $this->template->load('templates/dashboard', 'tracking/add', $data);
    }

    public function save($id)
    {

        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tracking';
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['action'] = 'tracking/save/'.$id;
            $data['id']=$id;
            setPesan(validation_errors(), false);
            $this->template->load('templates/dashboard', 'tracking/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input['trck_tgl']=date('Y-m-d');

            $insert = $this->admin->insert('tkt_tracking', $input);

            if ($insert) {
                setPesan('Berhasil menambahkan tracking baru');
                redirect('tracking/index/'.$id);
            } else {
                setPesan('Gagal menambahkan tracking baru');
                redirect('tracking/add/'.$id);
            }

            /* Debug */
            //print_r($input);
        }
    }
    public function edit($getId,$laporan_id)
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Tracking';
        $data['id']=$laporan_id;
        $data['action'] = 'tracking/update/'.$getId.'/'.$laporan_id;
        $data['tracking'] = $this->admin->get('tkt_tracking', ['trck_id' => $getId]);
        $this->template->load('templates/dashboard', 'tracking/add', $data);
    }
    public function update($getId,$laporan_id)
    {

        $this->_validasi();
        $id = encode_php_tags($this->input->post('trck_id'));
        $laporan=$this->input->post('trck_pgd_id');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'tracking';
            $data['id']=$laporan_id;        
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['action'] = 'tracking/update/'.$getId.'/'.$laporan_id;
            $data['tracking'] = $this->admin->get('tkt_tracking', ['trck_id' => $id]);
            $this->template->load('templates/dashboard', 'tracking/edit', $data);
        } else {

            $input['trck_status'] = $this->input->post('trck_status', true);
            $input['trck_keterangan'] = $this->input->post('trck_keterangan', true);

            $update = $this->admin->update('tkt_tracking', 'trck_id', $id, $input);

            if ($update) {
                setPesan('Berhasil update tracking');
                redirect('tracking/index/'.$laporan_id);
            } else {
                setPesan('Gagal update tracking');
                redirect('tracking/edit/' . $id .'/'.$laporan_id);
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
        redirect('tracking');
    }

  
}
