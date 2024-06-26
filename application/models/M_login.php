<?php
class M_login extends CI_Model {

    public function cek_login_angkringan($where) {
        $this->db->select('*');
        $this->db->from('angkringan');
        $this->db->where($where);
        return $this->db->get();
    }
    public function cek_login_karyawan($where) {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->where($where);
        return $this->db->get();
    }
    public function get_angkringan_id($username)
    {
        $this->db->select('id_angkringan');
        $this->db->where('username', $username);
        $query = $this->db->get('angkringan');
        if ($query->num_rows() > 0) {
            return $query->row()->id_angkringan;
        } else {
            return false;
        }
    }
    public function get_karyawan_id($username)
    {
        $this->db->select('id_karyawan');
        $this->db->where('username', $username);
        $query = $this->db->get('karyawan');
        if ($query->num_rows() > 0) {
            return $query->row()->id_karyawan;
        } else {
            return false;
        }
    }
    public function get_angkringan_id_by_karyawan_id($karyawan_id)
{
    $this->db->select('id_angkringan');
    $this->db->where('id_karyawan', $karyawan_id);
    $query = $this->db->get('karyawan');
    
    if ($query->num_rows() == 1) {
        // Ambil baris pertama dan kolom 'id_angkringan'
        return $query->row()->id_angkringan;
    } else {
        // Jika tidak ditemukan atau lebih dari satu, kembalikan null atau nilai default
        return null;
    }
} 

public function get_angkringan_id_by_username($username)
{
    $this->db->select('id_angkringan');
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
