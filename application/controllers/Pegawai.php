<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
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
        $data['pengaduan'] = $this->admin->notifPengajuanAdmin();
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->admin->getAllPegawai();
        $this->template->load('templates/dashboard', 'pegawai/index', $data);
    }

    public function _validasi()
    {
        $config = array(
            array(
                'field' => 'pg_nip',
                'label' => 'NIP',
                'rules' => 'required|numeric|is_unique[tkt_pegawai.pg_nip]',
                'errors' => array(
                    'required' => 'NIP tidak boleh kosong',
                    'numeric' => 'NIP hanya boleh berisi angka',
                    'is_unique' => 'NIP yang sama telah ada'
                )
            ),
            array(
                'field' => 'pg_nama',
                'label' => 'Nama Pegawai',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama Pegawai tidak boleh kosong',
                )
            ),

            array(
                'field' => 'pg_bdg_id',
                'label' => 'Bidang',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Bidang tidak boleh kosong',
                )
            ),

            array(
                'field' => 'pg_email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[tkt_pegawai.pg_email]',
                'errors' => array(
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email yang dimasukkan tidak valid',
                    'is_unique' => 'Email telah terdaftar, silahkan coba email yang lain',
                )
            ),
            array(
                'field' => 'pg_no_hp',
                'label' => 'No. HP',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Nomor HP tidak boleh kosong',
                    'numeric' => 'Nomor HP hanya boleh berisi angka'
                )
            ),
            // array(
            //     'field' => 'pg_password',
            //     'label' => 'Password',
            //     'rules' => 'required|min_length[6]|trim',
            //     'errors' => array(
            //         'required' => 'Password tidak boleh kosong',
            //         'min_length' => 'Password minimal 6 karakter'
            //     )
            // ),
            // array(
            //     'field' => 'password2',
            //     'label' => 'Konfirmasi Password',
            //     'rules' => 'matches[pg_password]|trim',
            //     'errors' => array(
            //         'matches' => 'Konfirmasi pg_password tidak sama',

            //     )
            // ),


        );
        $this->form_validation->set_rules($config);
    }

    public function _validasi_edit()
    {
        $config = array(

            array(
                'field' => 'pg_nama',
                'label' => 'Nama Pegawai',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama Pegawai tidak boleh kosong',
                )
            ),

            array(
                'field' => 'pg_bdg_id',
                'label' => 'Jabatan',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Jabatan tidak boleh kosong',
                )

            ),

            array(
                'field' => 'pg_nip',
                'label' => 'NIP',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Jabatan tidak boleh kosong',
                )
            ),
            // array(
            //     'field' => 'pg_password',
            //     'label' => 'Password',
            //     'rules' => 'required|min_length[6]|trim',
            //     'errors' => array(
            //         'required' => 'Password tidak boleh kosong',
            //         'min_length' => 'Password minimal 6 karakter'
            //     )
            // ),
            // array(
            //     'field' => 'password2',
            //     'label' => 'Konfirmasi Password',
            //     'rules' => 'matches[pg_password]|trim',
            //     'errors' => array(
            //         'matches' => 'Konfirmasi pg_password tidak sama',

            //     )
            // ),
            array(
                'field' => 'pg_email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[tkt_pegawai.pg_email]',
                'errors' => array(
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email yang dimasukkan tidak valid',
                    'is_unique' => 'Email telah terdaftar, silahkan coba email yang lain',
                )
            ),
            array(
                'field' => 'pg_no_hp',
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

    public function _validasiProfile()
    {
        $config = array(

            array(
                'field' => 'pg_nama',
                'label' => 'Nama Pegawai',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama Pegawai tidak boleh kosong',
                )
            ),

        );
        $this->form_validation->set_rules($config);
    }

    public function _uploadFile()
    {
        $config['upload_path'] = "./assets/files";
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '2000';

        $this->load->library('upload', $config);
    }

    public function add()
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['bidang'] = $this->admin->get('tkt_bidang');
        $data['title'] = 'Pegawai';
        $data['action'] = 'pegawai/save';
        $this->template->load('templates/dashboard', 'pegawai/add', $data);
    }

    public function save()
    {
        $this->_uploadFile();
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pegawai';
            $data['action'] = 'pegawai/save';
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['status'] = array("Aktif", "Tidak Aktif");
            $data['bidang'] = $this->admin->get('tkt_bidang');
            setPesan(validation_errors(), false);
            // print_r(validation_errors());
            $this->template->load('templates/dashboard', 'pegawai/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input['pg_password']              = password_hash($this->input->post('pg_nip'), PASSWORD_DEFAULT);            //random_string('alnum', 8);  
            // $input['status_pegawai']        = "Aktif";
            if (!$this->upload->do_upload('pg_foto')) {
                setPesan($this->upload->display_errors(),false);
                $data['title'] = 'Pegawai';
            $data['action'] = 'pegawai/save';
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['status'] = array("Aktif", "Tidak Aktif");
            $data['bidang'] = $this->admin->get('tkt_bidang');
           // setPesan(validation_errors(), false);
            // print_r(validation_errors());
            $this->template->load('templates/dashboard', 'pegawai/add', $data);
            } else {
                $file = $this->upload->data();
                $input['pg_foto'] = $file['file_name'];
                $insert = $this->admin->insert('tkt_pegawai', $input);
                if ($insert) {
                    // $array = array(
                    //     'pegawai_nip' => $this->input->post('pg_nip'),
                    //     'tanggal_masuk' => date('Y-m-d'),
                    //     'jam_masuk' => "",
                    //     'jam_keluar' => "",
                    // );
                    // $this->admin->insert('tb_absensi', $array);
                    setPesan('Berhasil menambahkan pegawai baru');
                    redirect('pegawai');
                } else {
                    setPesan('Gagal menambahkan pegawai baru');
                    redirect('pegawai/add');
                }
                /* Debug */
                //print_r($input);
            }
        }
    }
    public function edit($getId)
    {
        $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
        $data['pengaduan'] = $this->admin->notifPengajuanUmum();
        $data['title'] = 'Pegawai';
        $data['action'] = 'pegawai/update';
        $data['bidang'] = $this->admin->get('tkt_bidang');
        $data['pegawai'] = $this->admin->get('tkt_pegawai', ['pg_nip' => $getId]);
        $this->template->load('templates/dashboard', 'pegawai/edit', $data);
    }
    public function update()
    {
        $this->_validasi_edit();
        $this->_uploadFile();
        $id = encode_php_tags($this->input->post('pg_nip'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pegawai';
            $data['notifikasi'] = $this->admin->jumlahPengaduanByAdmin();
            $data['pengaduan'] = $this->admin->notifPengajuanUmum();
            $data['action'] = 'pegawai/update';
            $data['bidang'] = $this->admin->get('tkt_bidang');
            $data['pegawai'] = $this->admin->get('tkt_pegawai', ['pg_nip' => $id]);

            //   echo "dada";
            $this->template->load('templates/dashboard', 'pegawai/edit', $data);
        } else {
            $data = $this->input->post(null, true);
            // $data = array(
            //     'pg_nama' => $this->input->post('pg_nama'),
            //     'pg_bdg_id' => $this->input->post('pg_bdg_id'),
            //     // 'golongan_id' => $this->input->post('golongan_id')

            // );
            if (!empty($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                if (!$this->upload->do_upload('file')) {
                    // setPesan($this->upload->display_errors());
                    // print_r($this->upload->display_errors());
                    // die;
                } else {
                    $file = $this->upload->data();
                    $data['pg_foto'] = $file['file_name'];
                    // $input['file_type'] = $file['file_type'];


                    $update = $this->admin->update('tkt_pegawai', 'pg_nip', $id, $data);

                    if ($update) {
                        setPesan('Berhasil update pegawai');
                        redirect('pegawai');
                    } else {
                        setPesan('Gagal update pegawai');
                        redirect('pegawai/edit/' . $id);
                    }
                }
            } else {
                $update = $this->admin->update('tkt_pegawai', 'pg_nip', $id, $data);

                if ($update) {
                    setPesan('Berhasil update pegawai');
                    redirect('pegawai');
                } else {
                    setPesan('Gagal update pegawai');
                    redirect('pegawai/edit/' . $id);
                }
            }
        }

        /* Debug */
        //print_r($input);
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('tkt_pegawai', 'pg_nip', $id)) {
            setPesan('Pegawai berhasil dihapus.');
        } else {
            setPesan('Pegawai gagal dihapus.', false);
        }
        redirect('pegawai');
    }

    public function profile($getId)
    {
        $data['title'] = 'Profile Pegawai';
        $data['action'] = 'pegawai/updateProfile';
        // $data['pg_bdg_id'] = $this->admin->get('tb_jabatan');
        $data['pegawai'] = $this->admin->get('tkt_pegawai', ['pg_nip' => $getId]);
        $this->template->load('templates/dashboard_pegawai', 'pegawai/profile', $data);
    }

    public function updateProfile()
    {
        $this->_validasiProfile();
        $this->_uploadFile();
        $id = encode_php_tags($this->input->post('pg_nip'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Profile Pegawai';
            $data['action'] = 'pegawai/updateProfile';
            $data['pegawai'] = $this->admin->get('tkt_pegawai', ['pg_nip' => $id]);
            // $data['pg_bdg_id'] = $this->admin->get('tb_jabatan');
            setPesan(validation_errors(), false);
            //   echo "dada";
            $this->template->load('templates/dashboard_pegawai', 'pegawai/profile', $data);
        } else {
            $data = array(
                'pg_nama' => $this->input->post('pg_nama')
            );
            // $data['jabatan_id'] = $data['jabatan_id'] ? $data['jabatan_id'] : $this->admin->get('tkt_pegawai', ['pg_nip' => $id])['jabatan_id'];
            // $data['status_pegawai'] = $data['status_pegawai'] ? $data['status_pegawai'] : $this->admin->get('tkt_pegawai', ['pg_nip' => $id])['status_pegawai'];
            $data['pg_password'] = $this->input->post('pg_password') ? password_hash($this->input->post('pg_password'), PASSWORD_BCRYPT) :  $this->admin->get('tkt_pegawai', ['pg_nip' => $id])['pg_password'];
            if (!empty($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                if (!$this->upload->do_upload('file')) {
                    // setPesan($this->upload->display_errors());
                    print_r($this->upload->display_errors());
                    // die;
                } else {
                    // echo "dd";
                    $file = $this->upload->data();
                    $data['pg_foto'] = $file['file_name'];
                    // $input['file_type'] = $file['file_type'];


                    $update = $this->admin->update('tkt_pegawai', 'pg_nip', $id, $data);
                    // echo "dd1";
                    if ($update) {
                        setPesan('Berhasil update pegawai');
                        redirect('pegawai/profile/' . $id);
                    } else {
                        setPesan('Gagal update pegawai');
                        redirect('pegawai/profile/' . $id);
                    }
                }
            } else {

                $update = $this->admin->update('tkt_pegawai', 'pg_nip', $id, $data);
                // echo "dd2";
                // $update = $this->admin->update('tkt_pegawai', 'pg_nip', $id, $input);

                if ($update) {
                    setPesan('Berhasil update pegawai');
                    redirect('pegawai/profile/' . $id);
                } else {
                    setPesan('Gagal update pegawai');
                    redirect('pegawai/profile/' . $id);
                }
                /* Debug */
                //print_r($input);
            }
        }
    }
   
}
