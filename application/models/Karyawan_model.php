<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_model extends CI_Model {

    public function getNamaByUserName($username) {
        $this->db->select('nama_karyawan');
        $this->db->where('username', $username);
        $query = $this->db->get('karyawan');

        if ($query->num_rows() > 0) {
            return $query->row()->nama_karyawan;
        } else {
            return 'Nama tidak ditemukan';
        }
    }
}
?>
