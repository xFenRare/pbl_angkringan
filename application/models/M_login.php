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

    public function get_angkringan_id($username)
    {
        $this->db->select('id_angkringan'); // Sesuaikan dengan nama kolom yang benar
        $this->db->where('username', $username);
        $query = $this->db->get('angkringan');
        if ($query->num_rows() > 0) {
            return $query->row()->id_angkringan;
        } else {
            return false;
        }
    }
}
?>
