<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['title'] = 'Admin';
        $role1 = [
            'usr_role' => 'Bagian Umum',
            'usr_role' => 'Administrator',
            
        ];
        
        $data['user'] = $this->admin->getUser();
        $this->template->load('templates/dashboard', 'user/index', $data);
    }

    public function teknisi()
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Admin';
        $data['user'] = $this->admin->get('tkt_user', '', ['usr_role' => 'Teknisi IT']);
        $this->template->load('templates/dashboard', 'user/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'usr_username',
                'label' => 'Username',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Username tidak boleh kosong',
                )
            ),

            array(
                'field' => 'usr_password',
                'label' => 'Password',
                'rules' => 'required|min_length[6]|trim',
                'errors' => array(
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 6 karakter'
                )
            ),
            // array(
            //     'field' => 'password2',
            //     'label' => 'Konfirmasi Password',
            //     'rules' => 'matches[password]|trim',
            //     'errors' => array(
            //         'matches' => 'Konfirmasi password tidak sama',

            //     )
            // ),
            array(
                'field' => 'usr_role',
                'label' => 'Role User',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Role User tidak boleh kosong',
                )
            ),
            array(
                'field' => 'usr_nama',
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama User tidak boleh kosong',
                )
            ),
            array(
                'field' => 'usr_alamat',
                'label' => 'Alamat',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Alamat tidak boleh kosong',
                )
            ),
            array(
                'field' => 'usr_no_hp',
                'label' => 'No. HP',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Nomor HP tidak boleh kosong',
                    'numeric' => 'Nomor HP hanya boleh berisi angka'
                )
            ),

        );
        $this->form_validation->set_rules($config);
    }

    public function _validasi_edit()
    {
        $config = array(
            array(
                'field' => 'usr_username',
                'label' => 'Username',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Username tidak boleh kosong',
                )
            ),

            // array(
            //     'field' => 'password2',
            //     'label' => 'Konfirmasi Password',
            //     'rules' => 'matches[password]|trim',
            //     'errors' => array(
            //         'matches' => 'Konfirmasi password tidak sama',

            //     )
            // ),
            // array(
            //     'field' => 'usr_role',
            //     'label' => 'Role User',
            //     'rules' => 'required|trim',
            //     'errors' => array(
            //         'required' => 'Role User tidak boleh kosong',
            //     )
            // ),
            array(
                'field' => 'usr_nama',
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama User tidak boleh kosong',
                )
            ),
            array(
                'field' => 'usr_alamat',
                'label' => 'Alamat',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'Alamat tidak boleh kosong',
                )
            ),
            array(
                'field' => 'usr_email',
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => array(
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email yang dimasukkan tidak valid',
                    'is_unique' => 'Email telah terdaftar, silahkan coba email yang lain',
                )
            ),
            array(
                'field' => 'usr_no_hp',
                'label' => 'No. HP',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Nomor HP tidak boleh kosong',
                    'numeric' => 'Nomor HP hanya boleh berisi angka'
                )
            ),

        );
        $this->form_validation->set_rules($config);
    }
    public function add()
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'User';
        $data['action'] = 'user/save';
        $this->template->load('templates/dashboard', 'user/add', $data);
    }

    public function save()
    {

        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User';
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['action'] = 'user/save';
            // setPesan(validation_errors(),false);
            $this->template->load('templates/dashboard', 'user/add', $data);
        } else {
            $input = $this->input->post(null, true);

            $input['usr_password'] = password_hash($input['usr_password'], PASSWORD_DEFAULT);
            $insert = $this->admin->insert('tkt_user', $input);

            if ($insert) {
                setPesan('Berhasil menambahkan user baru');
                if($input['usr_role']=='Teknisi IT') {
                    redirect('user/teknisi');
                }else {

                    redirect('user');
                }
            } else {
                setPesan('Gagal menambahkan user baru');
                redirect('user/add');
            }

            /* Debug */
            //print_r($input);
        }
    }
    public function edit($getId)
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'User';
        $data['action'] = 'user/update';
        $data['user'] = $this->admin->get('tkt_user', ['usr_id' => $getId]);
        $this->template->load('templates/dashboard', 'user/edit', $data);
    }
    public function update()
    {

        $this->_validasi_edit();
        $id = encode_php_tags($this->input->post('usr_id'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User';
            $data['action'] = 'user/update';
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['user'] = $this->admin->get('tkt_user', ['usr_id' => $id]);
            $this->template->load('templates/dashboard', 'user/edit', $data);
        } else {

            $input = $this->input->post(null, true);
            $input['usr_password'] = $input['usr_password'] ? password_hash($input['usr_password'], PASSWORD_DEFAULT) :  $this->admin->get('tkt_user', ['usr_id' => $id])['usr_password'];

            $update = $this->admin->update('tkt_user', 'usr_id', $id, $input);

            if ($update) {
                setPesan('Berhasil update user');
                if($input['usr_role']=='Teknisi IT') {
                    redirect('user/teknisi');
                }else {

                    redirect('user');
                }
            } else {
                setPesan('Gagal update user');
                redirect('user/edit/' . $id);
            }



            /* Debug */
            //print_r($input);
        }
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('tkt_user', 'usr_id', $id)) {
            setPesan('user berhasil dihapus.');
            if($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'teknisi') {
                redirect('user/teknisi');
            }else {
    
                redirect('user');
            }
        } else {
            setPesan('user gagal dihapus.', false);
            if($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'teknisi') {
                redirect('user/teknisi');
            }else {
    
                redirect('user');
            }
        }
    }

    public function profile($getId)
    {
        $data['title'] = 'Profile';
        if (isBagianUmum()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        } elseif (isAdmin()) {
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        }
        $data['pengajuan'] = $this->admin->notifPengajuanUmum();
        $data['action'] = 'user/updateUmum';
        $data['user'] = $this->admin->get('tkt_user', ['usr_id' => $getId]);
        $this->template->load('templates/dashboard', 'user/edit', $data);
    }
    public function updateUmum()
    {

        $this->_validasi_edit();
        $data['notifikasi'] = $this->admin->jumlahPengaduanByUmum();
        $data['pengajuan'] = $this->admin->notifPengajuanUmum();
        $id = encode_php_tags($this->input->post('usr_id'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User';
            $data['action'] = 'user/updateUmum';
            setPesan(validation_errors(), false);
            $data['user'] = $this->admin->get('tkt_user', ['usr_id' => $id]);
            $this->template->load('templates/dashboard', 'user/edit', $data);
        } else {

            $input = $this->input->post(null, true);

            $input['usr_password'] = $input['usr_password'] ? password_hash($input['usr_password'], PASSWORD_DEFAULT) :  $this->admin->get('tkt_user', ['usr_id' => $id])['usr_password'];

            $update = $this->admin->update('tkt_user', 'usr_id', $id, $input);

            if ($update) {
                setPesan('Berhasil update user');
                redirect('user/profile/' . $id);
            } else {
                setPesan('Gagal update user');
                redirect('user/profile/' . $id);
            }



            /* Debug */
            //print_r($input);
        }
    }
}
