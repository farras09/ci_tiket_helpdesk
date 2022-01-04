    <?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class Auth extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('Auth_model', 'auth');
            $this->load->model('Admin_model', 'admin');
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

        private function _has_login()
        {
            if ($this->session->has_userdata('login_session')) {
                redirect('dashboard');
            }
        }

        public function index()
        {
            $this->_has_login();

            $this->form_validation->set_rules('usr_username', 'Username', 'required|trim');
            $this->form_validation->set_rules('usr_password', 'Password', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Aplikasi';
                $this->template->load('templates/auth', 'auth/login', $data);
            } else {
                $input = $this->input->post(null, true);

                $cek_username = $this->auth->cekUsername($input['usr_username']);
                if ($cek_username > 0) {
                    $password = $this->auth->getPassword($input['usr_username']);
                    if (password_verify($input['usr_password'], $password)) {
                        $user_db = $this->auth->userdata($input['usr_username']);

                        $userdata = [
                            'id' => $user_db['usr_id'],
                            'user'  => $user_db['usr_username'],
                            'role'  => $user_db['usr_role'],
                            'nama'  => $user_db['usr_nama'],

                        ];
                        $this->session->set_userdata('login_session', $userdata);
                        redirect('dashboard');
                    } else {
                        // echo $password;
                        setPesan('password salah', false);
                        redirect('auth');
                    }
                } else {
                    setPesan('akun tidak ditemukan', false);
                    redirect('auth');
                }
            }
        }

        public function logout()
        {
            $this->session->unset_userdata('login_session');

            setPesan('anda telah berhasil logout');
            redirect('auth');
        }

        public function form_pegawai()
        {
            $this->_has_login();

            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Aplikasi Pegawai';
                $this->template->load('templates/auth', 'auth/login_pegawai', $data);
            } else {
                $input = $this->input->post(null, true);

                $cek_username = $this->auth->cekNip($input['username']);
                if ($cek_username > 0) {
                    $password = $this->auth->getPasswordNip($input['username']);
                    if (password_verify($input['password'], $password)) {
                        $user_db = $this->auth->userdataPegawai($input['username']);

                        $userdata = [
                            'nip' => $user_db['pg_nip'],
                            // 'user'  => $user_db['nama_pegawai'],
                            'role'  => "Pegawai",
                            'nama'  => $user_db['pg_nama'],

                        ];
                        $this->session->set_userdata('login_session', $userdata);
                        redirect('dashboard/pegawai');
                    } else {
                        setPesan('password salah', false);
                        redirect('auth/form_pegawai');
                    }
                } else {
                    setPesan('akun tidak ditemukan', false);
                    redirect('auth/form_pegawai');
                }
            }
        }
    }
