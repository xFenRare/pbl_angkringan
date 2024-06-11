<?php

class M_login extends CI_Model {

    public function cek_login_angkringan($where) {
        // Mencari username dan password di tabel angkringan
        $this->db->select('*');
        $this->db->from('angkringan');
        $this->db->where($where);

        $query = $this->db->get();
        return $query;
    }

    public function cek_login_karyawan($where) {
        // Mencari username dan password di tabel karyawan
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->where($where);

        $query = $this->db->get();
        return $query;
    }

}
?>
