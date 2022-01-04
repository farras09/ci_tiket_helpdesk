<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
        $data['title'] = 'jurusan';
        $data['jurusan'] = $this->admin->get('jurusan');
        $this->template->load('templates/dashboard', 'jurusan/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'jurusan',
                'label' => 'jurusan',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'jurusan tidak boleh kosong'
                )
            )

        );
        $this->form_validation->set_rules($config);
    }
    public function add()
    {

        $data['title'] = 'Jurusan';
        $data['action'] = 'jurusan/save';
        $this->template->load('templates/dashboard', 'jurusan/add', $data);
    }

    public function save()
    {
       
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Jurusan';
            $data['action'] = 'jurusan/save';
            // setPesan(validation_errors(),false);
            $this->template->load('templates/dashboard', 'jurusan/add', $data);
        } else {
            $input = $this->input->post(null, true);


            $insert = $this->admin->insert('jurusan', $input);

            if ($insert) {
                setPesan('Berhasil menambahkan jurusan baru');
                redirect('jurusan');
            } else {
                setPesan('Gagal menambahkan jurusan baru');
                redirect('jurusan/add');
            }

            /* Debug */
            //print_r($input);
        }
    }
    public function edit($getId)
    {
        $data['title'] = 'Jurusan';
        $data['action'] = 'jurusan/update';
        $data['jurusan'] = $this->admin->get('jurusan', ['id' => $getId]);
        $this->template->load('templates/dashboard', 'jurusan/edit', $data);
    }
    public function update()
    {
     
        $this->_validasi();
        $id = encode_php_tags($this->input->post('id'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Jurusan';
            $data['action'] = 'jurusan/update';
            $data['jurusan'] = $this->admin->get('jurusan', ['id' => $id]);
            $this->template->load('templates/dashboard', 'jurusan/edit', $data);
        } else {

            $input = $this->input->post(null, true);

            $update = $this->admin->update('jurusan', 'id', $id, $input);

            if ($update) {
                setPesan('Berhasil update jurusan');
                redirect('jurusan');
            } else {
                setPesan('Gagal update jurusan');
                redirect('jurusan/edit/' . $id);
            }



            /* Debug */
            //print_r($input);
        }
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('jurusan', 'id', $id)) {
            setPesan('jurusan berhasil dihapus.');
        } else {
            setPesan('jurusan gagal dihapus.', false);
        }
        redirect('jurusan');
    }
}
