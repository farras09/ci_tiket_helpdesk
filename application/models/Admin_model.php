<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    # Get data

    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function getUser()
    {
        $this->db->where('usr_role =', 'Administrator');
        $this->db->or_where('usr_role =', 'Bagian Umum');
        return $this->db->get('tkt_user')->result_array();
    }

    # Update data
    public function update($table, $primaryKey, $id, $data)
    {
        $this->db->where($primaryKey, $id);
        return $this->db->update($table, $data);
    }

    # Insert data
    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    # Delete data
    public function delete($table, $primaryKey, $id)
    {
        return $this->db->delete($table, [$primaryKey => $id]);
    }

    # Count all data
    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function getJumlahPengaduanPerHari()
    {
        $this->db->where('DATE(pgd_tgl_pengaduan)', date('Y-m-d'));
        return $this->db->get('tkt_pengaduan')->num_rows();
    }

    public function getJumlahPengaduan($status)
    {
        $this->db->where('pgd_umum_status', $status);
        return $this->db->get('tkt_pengaduan')->num_rows();
    }

    public function getJumlahPengaduanPerPegawai($nip, $status)
    {
        $this->db->where('pgd_pg_nip', $nip);
        $this->db->where('pgd_umum_status', $status);
        return $this->db->get('tkt_pengaduan')->num_rows();
    }

    public function getPengaduan($id)
    {

        $this->db->select('bd.*, pg.*,pgd.*');
        $this->db->join('tkt_pegawai pg', 'pg.pg_nip = pgd.pgd_pg_nip', 'left');
        $this->db->join('tkt_bidang bd', 'bd.bd_id = pg.pg_bdg_id', 'left');
        $this->db->where('pgd_id', $id);
        return $this->db->get('tkt_pengaduan pgd')->row_array();
    }

    public function getPenugasan($teknisi)
    {

        $this->db->select('bd.*, pg.*,pgd.*');
        $this->db->join('tkt_pegawai pg', 'pg.pg_nip = pgd.pgd_pg_nip', 'left');
        $this->db->join('tkt_bidang bd', 'bd.bd_id = pg.pg_bdg_id', 'left');
        $this->db->where('pgd_teknisi', $teknisi);
        return $this->db->get('tkt_pengaduan pgd')->result_array();
    }

    public function getStatusPenugasan($teknisi, $status)
    {
        $this->db->where('pgd_teknisi', $teknisi);
        $this->db->where('pgd_teknisi_status', $status);
        return $this->db->get('tkt_pengaduan')->num_rows();
    }

    public function getTrackingLaporan($user_id = null)
    {

        // return $this->db->select('*')->where('pgd_pg_nip =',$user_id)->join('tkt_tracking trck', 'trck.trck_pg_id = pgd.pgd_id','left')->order_by('pgd_id',"desc")->limit(1)->get('tkt_pengaduan pgd')->result_array();
        return $this->db->select('*')->where('pgd_pg_nip =', $user_id)->order_by('pgd_id', "desc")->limit(1)->get('tkt_pengaduan')->row_array();
    }

    public function get_max_id($table, $field, $where)
    {
        $this->db->select_max($field);
        $this->db->where($where);
        $sql = $this->db->get($table);
        return $sql;
    }

    public function jumlahPengaduanByAdmin()
    {
        // $this->db->where('pgd_biaya_perbaikan =', 0);
        // $this->db->where('pgd_adm_status =', 'Diproses');
        // $this->db->or_where('pgd_umum_status =', 'Diterima');
        // $this->db->or_where('pgd_umum_status =', 'Ditunda');
        $this->db->where('pgd_read_by_admin =', 0);
        $query = $this->db->get('tkt_pengaduan');
        return $query->num_rows();
    }

    public function getAllPegawai()
    {
        $this->db->select('bd.*, pg.*');
        $this->db->join('tkt_bidang bd', 'pg.pg_bdg_id = bd.bd_id', 'left');
        // $this->db->join('tb_golongan g', 'p.golongan_id = g.id');
        return $this->db->get('tkt_pegawai pg')->result_array();
    }

    public function jumlahPengaduanByUmum()
    {
        $this->db->where('pgd_biaya_perbaikan ', 1);
        // $this->db->or_where('pgd_adm_status =', 'Diterima');
        // $this->db->or_where('pgd_umum_status =', 'Diproses');
        // $this->db->where('pgd_read_by_umum =', 0);
        // $this->db->or_where('pgd_read_by_umum =', 1);
        $query = $this->db->get('tkt_pengaduan');
        return $query->num_rows();
    }

    public function notifPengajuanUmum()
    {
        $this->db->select('pegawai.pg_nama, aduan.*');
        // $this->db->join('tkt_ticket tiket', 'tiket.tk_id = aduan.pgd_tk_id ','left');
        $this->db->join('tkt_pegawai pegawai', 'pegawai.pg_nip = aduan.pgd_pg_nip ', 'left');
        $this->db->where('pgd_biaya_perbaikan =', 1);
        // $this->db->where('pgd_adm_status =', 'Diterima');
        // $this->db->where('pgd_umum_status =', 'Diproses');
        $this->db->where('pgd_read_by_umum =', 0);
        $query = $this->db->get('tkt_pengaduan aduan');
        return $query->result_array();
    }


    public function notifPengajuanAdmin()
    {
        $this->db->select('pegawai.pg_nama, aduan.*');
        // $this->db->join('tkt_ticket tiket', 'tiket.tk_id = aduan.pgd_tk_id ','left');
        $this->db->join('tkt_pegawai pegawai', 'pegawai.pg_nip = aduan.pgd_pg_nip ', 'left');
        // $this->db->where('pgd_biaya_perbaikan =', 0);
        // $this->db->where('pgd_adm_status =', 'Diproses');
        // $this->db->or_where('pgd_umum_status =', 'Diterima');
        // $this->db->or_where('pgd_umum_status =', 'Ditunda');
        $this->db->or_where('pgd_read_by_admin =', 0);
        $query = $this->db->get('tkt_pengaduan aduan');
        return $query->result_array();
    }


    public function dataPengaduan($status_perbaikan = null)
    {
        if ($status_perbaikan != null) {
            $this->db->select('pegawai.pg_nama, ajuan.*, bidang.bd_nama_bidang');
            $this->db->join('tkt_pegawai pegawai', ' pegawai.pg_nip = ajuan.pgd_pg_nip', 'left');
            $this->db->join('tkt_bidang bidang', 'bidang.bd_id = pegawai.pg_bdg_id', 'left');
            $this->db->where('pgd_biaya_perbaikan =', $status_perbaikan);
            $query = $this->db->get('tkt_pengaduan ajuan');
            return $query->result_array();
        } else {
            $this->db->select('pegawai.pg_nama, ajuan.*, bidang.bd_nama_bidang');
            $this->db->join('tkt_pegawai pegawai', ' pegawai.pg_nip = ajuan.pgd_pg_nip', 'left');
            $this->db->join('tkt_bidang bidang', 'bidang.bd_id = pegawai.pg_bdg_id', 'left');
            $query = $this->db->get('tkt_pengaduan ajuan');
            return $query->result_array();
        }
    }

    public function dataRekapPengaduan($status_laporan = null)
    {
        if ($status_laporan != null) {
            $this->db->select('pegawai.pg_nama, ajuan.*, bidang.bd_nama_bidang');
            $this->db->join('tkt_pegawai pegawai', ' pegawai.pg_nip = ajuan.pgd_pg_nip', 'left');
            $this->db->join('tkt_bidang bidang', 'bidang.bd_id = pegawai.pg_bdg_id', 'left');
            $this->db->where('pgd_umum_status =', $status_laporan);
            // $this->db->where('MONTH(pgd_tgl_pengaduan)', date('m'));
            $query = $this->db->get('tkt_pengaduan ajuan');
            return $query->result_array();
        }
    }
    public function kode_laporan()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(pgd_id,6)) AS kd_max FROM tkt_pengaduan");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "LP" . date('dmy') . $kd;
    }

    public function updateMass($table, $content)
    {
        return $this->db->update($table, $content);
    }

    public function tahunPengaduan()
    {
        $this->db->select('YEAR(ajuan.pgd_tgl_pengaduan) as year');
        $this->db->from('tkt_pengaduan ajuan');
        $this->db->order_by('YEAR(ajuan.pgd_tgl_pengaduan)');
        $this->db->group_by('YEAR(ajuan.pgd_tgl_pengaduan)');
        return $this->db->get()->result_array();
    }

    public function cetakPengaduan($status_perbaikan = null)
    {
        $this->db->select('pegawai.pg_nama, ajuan.*, bidang.bd_nama_bidang');
        $this->db->join('tkt_pegawai pegawai', ' pegawai.pg_nip = ajuan.pgd_pg_nip', 'left');
        $this->db->join('tkt_bidang bidang', 'bidang.bd_id = pegawai.pg_bdg_id', 'left');
        $this->db->from('tkt_pengaduan ajuan');
        $this->db->order_by('YEAR(ajuan.pgd_tgl_pengaduan)');
        if ($status_perbaikan != NULL) {
            $this->db->where('pgd_biaya_perbaikan =', $status_perbaikan);
        }
        // $this->db->where('pgd_umum_status =', NULL);
        // $this->db->group_by('YEAR(ajuan.pgd_tgl_pengaduan)');
        return $this->db->get()->result_array();
    }

    public function cetakPengaduanPerTanggal($date)
    {
        $this->db->select('pegawai.pg_nama, ajuan.*, bidang.bd_nama_bidang');
        $this->db->join('tkt_pegawai pegawai', ' pegawai.pg_nip = ajuan.pgd_pg_nip', 'left');
        $this->db->join('tkt_bidang bidang', 'bidang.bd_id = pegawai.pg_bdg_id', 'left');
        $this->db->from('tkt_pengaduan ajuan');
        $this->db->where('DATE(ajuan.pgd_tgl_pengaduan)', $date);
        return $this->db->get()->result_array();
    }

    public function cetakPengaduanPerBulan($month, $year)
    {
        $this->db->select('pegawai.pg_nama, ajuan.*, bidang.bd_nama_bidang');
        $this->db->join('tkt_pegawai pegawai', ' pegawai.pg_nip = ajuan.pgd_pg_nip', 'left');
        $this->db->join('tkt_bidang bidang', 'bidang.bd_id = pegawai.pg_bdg_id', 'left');
        $this->db->from('tkt_pengaduan ajuan');
        $this->db->where('MONTH(ajuan.pgd_tgl_pengaduan)', $month);
        $this->db->where('YEAR(ajuan.pgd_tgl_pengaduan)', $year);

        return $this->db->get()->result_array();
    }

    public function cetakPengaduanPerTahun($year)
    {
        $this->db->select('pegawai.pg_nama, ajuan.*, bidang.bd_nama_bidang');
        $this->db->join('tkt_pegawai pegawai', ' pegawai.pg_nip = ajuan.pgd_pg_nip', 'left');
        $this->db->join('tkt_bidang bidang', 'bidang.bd_id = pegawai.pg_bdg_id', 'left');
        $this->db->from('tkt_pengaduan ajuan');
        $this->db->where('YEAR(ajuan.pgd_tgl_pengaduan)', $year);
        return $this->db->get()->result_array();
    }
}
