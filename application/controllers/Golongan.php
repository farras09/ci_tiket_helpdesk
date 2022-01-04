<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Golongan extends CI_Controller
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
        $data['title'] = 'Golongan';
        $data['golongan'] = $this->admin->get('tb_golongan');
        $this->template->load('templates/dashboard', 'golongan/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'golongan',
                'label' => 'Golongan',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Golongan tidak boleh kosong'
                )
            )

        );
        $this->form_validation->set_rules($config);
    }
    public function add()
    {

        $data['title'] = 'Golongan';
        $data['action'] = 'golongan/save';
        $this->template->load('templates/dashboard', 'golongan/add', $data);
    }

    public function save()
    {
       
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'golongan';
            $data['action'] = 'golongan/save';
            // setPesan(validation_errors(),false);
            $this->template->load('templates/dashboard', 'golongan/add', $data);
        } else {
            $input = $this->input->post(null, true);


            $insert = $this->admin->insert('tb_golongan', $input);

            if ($insert) {
                setPesan('Berhasil menambahkan golongan baru');
                redirect('golongan');
            } else {
                setPesan('Gagal menambahkan golongan baru');
                redirect('golongan/add');
            }

            /* Debug */
            //print_r($input);
        }
    }
    public function edit($getId)
    {
        $data['title'] = 'Golongan';
        $data['action'] = 'golongan/update';
        $data['golongan'] = $this->admin->get('tb_golongan', ['id' => $getId]);
        $this->template->load('templates/dashboard', 'golongan/edit', $data);
    }
    public function update()
    {
     
        $this->_validasi();
        $id = encode_php_tags($this->input->post('id'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'golongan';
            $data['action'] = 'golongan/update';
            $data['golongan'] = $this->admin->get('tb_golongan', ['id' => $id]);
            $this->template->load('templates/dashboard', 'golongan/edit', $data);
        } else {

            $input = $this->input->post(null, true);

            $update = $this->admin->update('tb_golongan', 'id', $id, $input);

            if ($update) {
                setPesan('Berhasil update golongan');
                redirect('golongan');
            } else {
                setPesan('Gagal update golongan');
                redirect('golongan/edit/' . $id);
            }



            /* Debug */
            //print_r($input);
        }
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('tb_golongan', 'id', $id)) {
            setPesan('golongan berhasil dihapus.');
        } else {
            setPesan('golongan gagal dihapus.', false);
        }
        redirect('golongan');
    }
}
