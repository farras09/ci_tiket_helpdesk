<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
        $data['title'] = 'Kategori';
        $data['kategori'] = $this->admin->get('category');
        $this->template->load('templates/dashboard', 'kategori/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'category',
                'label' => 'Kategori',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'kategori tidak boleh kosong'
                )
            )

        );
        $this->form_validation->set_rules($config);
    }
    public function add()
    {

        $data['title'] = 'Kategori';
        $data['action'] = 'kategori/save';
        $this->template->load('templates/dashboard', 'kategori/add', $data);
    }

    public function save()
    {
       
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kategori';
            $data['action'] = 'kategori/save';
            // setPesan(validation_errors(),false);
            $this->template->load('templates/dashboard', 'kategori/add', $data);
        } else {
            $input = $this->input->post(null, true);


            $insert = $this->admin->insert('category', $input);

            if ($insert) {
                setPesan('Berhasil menambahkan kategori baru');
                redirect('kategori');
            } else {
                setPesan('Gagal menambahkan kategori baru');
                redirect('kategori/add');
            }

            /* Debug */
            //print_r($input);
        }
    }
    public function edit($getId)
    {
        $data['title'] = 'Kategori';
        $data['action'] = 'kategori/update';
        $data['kategori'] = $this->admin->get('category', ['id' => $getId]);
        $this->template->load('templates/dashboard', 'kategori/edit', $data);
    }
    public function update()
    {
     
        $this->_validasi();
        $id = encode_php_tags($this->input->post('id'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'kategori';
            $data['action'] = 'kategori/update';
            $data['kategori'] = $this->admin->get('category', ['id' => $id]);
            $this->template->load('templates/dashboard', 'kategori/edit', $data);
        } else {

            $input = $this->input->post(null, true);

            $update = $this->admin->update('category', 'id', $id, $input);

            if ($update) {
                setPesan('Berhasil update kategori');
                redirect('kategori');
            } else {
                setPesan('Gagal update kategori');
                redirect('kategori/edit/' . $id);
            }



            /* Debug */
            //print_r($input);
        }
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('category', 'id', $id)) {
            setPesan('kategori berhasil dihapus.');
        } else {
            setPesan('kategori gagal dihapus.', false);
        }
        redirect('kategori');
    }
}
