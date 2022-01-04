<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function cekUsername($username)
    {
        $query = $this->db->get_where('tkt_user', ['usr_username' => $username]);
        return $query->num_rows();
    }

    public function getPassword($username)
    {
        $data = $this->db->get_where('tkt_user', ['usr_username' => $username])->row_array();
        return $data['usr_password'];
    }

    public function userdata($username)
    {
        return $this->db->get_where('tkt_user', ['usr_username' => $username])->row_array();
    }

    public function cekNip($username)
    {
        $query = $this->db->get_where('tkt_pegawai', ['pg_nip' => $username]);
        return $query->num_rows();
    }

    public function getPasswordNip($username)
    {
        $data = $this->db->get_where('tkt_pegawai', ['pg_nip' => $username])->row_array();
        return $data['pg_password'];
    }
    public function userdataPegawai($username)
    {
        return $this->db->get_where('tkt_pegawai', ['pg_nip' => $username])->row_array();
    }
}
