<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_daftar extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data) {
        return $this->db->insert('angkringan', $data);
    }

    // Tambahkan metode lain jika diperlukan

}
?>
