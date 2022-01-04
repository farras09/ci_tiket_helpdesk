<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status_kehadiran extends CI_Controller
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
        $data['title'] = 'Status Kehadiran';
        $data['status_kehadiran'] = $this->admin->get('tb_status_kehadiran');
        $this->template->load('templates/dashboard', 'status_kehadiran/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'status_kehadiran',
                'label' => 'Status Kehadiran',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Status Kehadiran tidak boleh kosong'
                )
            )

        );
        $this->form_validation->set_rules($config);
    }
    public function add()
    {

        $data['title'] = 'Status Kehadiran';
        $data['action'] = 'status_kehadiran/save';
        $this->template->load('templates/dashboard', 'status_kehadiran/add', $data);
    }

    public function save()
    {

        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'status_kehadiran';
            $data['action'] = 'status_kehadiran/save';
            // setPesan(validation_errors(),false);
            $this->template->load('templates/dashboard', 'status_kehadiran/add', $data);
        } else {
            $input = $this->input->post(null, true);


            $insert = $this->admin->insert('tb_status_kehadiran', $input);

            if ($insert) {
                setPesan('Berhasil menambahkan Status Kehadiran baru');
                redirect('status_kehadiran');
            } else {
                setPesan('Gagal menambahkan Status Kehadiran baru');
                redirect('status_kehadiran/add');
            }

            /* Debug */
            //print_r($input);
        }
    }
    public function edit($getId)
    {
        $data['title'] = 'Status Kehadiran';
        $data['action'] = 'status_kehadiran/update';
        $data['status_kehadiran'] = $this->admin->get('tb_status_kehadiran', ['id' => $getId]);
        $this->template->load('templates/dashboard', 'status_kehadiran/edit', $data);
    }
    public function update()
    {

        $this->_validasi();
        $id = encode_php_tags($this->input->post('id'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'status_kehadiran';
            $data['action'] = 'status_kehadiran/update';
            $data['status_kehadiran'] = $this->admin->get('tb_status_kehadiran', ['id' => $id]);
            $this->template->load('templates/dashboard', 'status_kehadiran/edit', $data);
        } else {

            $input = $this->input->post(null, true);

            $update = $this->admin->update('tb_status_kehadiran', 'id', $id, $input);

            if ($update) {
                setPesan('Berhasil update Status Kehadiran');
                redirect('status_kehadiran');
            } else {
                setPesan('Gagal update Status Kehadiran');
                redirect('status_kehadiran/edit/' . $id);
            }



            /* Debug */
            //print_r($input);
        }
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('tb_status_kehadiran', 'id', $id)) {
            setPesan('Status Kehadiran berhasil dihapus.');
        } else {
            setPesan('Status Kehadiran gagal dihapus.', false);
        }
        redirect('status_kehadiran');
    }
}
